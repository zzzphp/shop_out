<?php

namespace App\Http\Controllers\Api;

use App\Models\AssetDetails;
use App\Models\Currency;
use App\Models\Order;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Exceptions\InternalException;
use App\Jobs\CloseOrder;

class OrdersController extends Controller
{
    //
    public function store(OrderRequest $request)
    {
        $order = DB::transaction(function() use ($request){
            $product = Product::query()->where('id', $request->product_id)->first();
            $order = new Order([
                'amount'      => $request->amount,
                'payment_price'      => $request->amount * $product->price,
                'total_amount' => $request->amount * $product->price,
                'remark'        => $request->input('remark', ''),
                'status'       => Order::STATUS_PENDING,
                'payment_method'  => 'CNY',
                'total_powers' => $product->amount * $request->amount,
                'currency_id' => 1,
            ]);
            $order->user()->associate($request->user());
            $order->product()->associate($product);
            //减少产品库存
            if($product->decreaseStock($request->amount) <= 0) {
                throw new InternalException("库存不足");
            }
            // 扣除余额
//            $wallet = Wallet::query()
//                            ->where('user_id', $request->user()->id)
//                            ->where(['currency_id' => 1, 'type' => Currency::TYPE_LEFAL])
//                            ->first();
//            $wallet->subAmount($request->amount * $product->price, AssetDetails::TYPE_BUY);
            $order->save();
           return $order;
        });
        // 延时队列关闭未支付的订单
        dispatch(new CloseOrder($order, config('app.order_ttl')));
        $order->usdt_amount = round($order->total_amount/config('site.usdt'), 2);
        return response()->json(['data' => $order]);
    }

    public function index(Request $request)
    {
        $builder = Order::query()->orderBy('id','desc')
        ->with(['product'])
        ->where('user_id', $request->user()->id);
        if ($request->input('status', '')) {
            $builder->where('status', $request->input('status'));
        }

        return response()->json(['data' => $builder->get()]);
    }

    public function show(Order $order)
    {
        $this->authorize('own', $order);
        $order->prodct = Product::find($order->product_id);
        return response()->json(['data' => $order]);
    }

    public function prove(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $order = Order::find($request->input('id'));
        $this->authorize('own', $order);
        if ($order->closed)
            $this->errorResponse(400, '订单已关闭，请重新下单！');
        if ($order->status !== Order::STATUS_PENDING) {
            $this->errorResponse(400, '订单状态不正确');
        }
        $order = DB::transaction(function () use ($order){
            $order->paid_prove = 'true';
            $order->status = Order::STATUS_SUCCESS;
            $order->payment_method = '余额';
            $order->payment_price = $order->total_amount;
            $order->paid_at = Carbon::now()->toDateTimeString();
            $order->save();

            // 扣除余额
            $wallet = Wallet::query()
                            ->where('user_id', $order->user_id)
                            ->where(['currency_id' => 1, 'type' => Currency::TYPE_LEFAL])
                            ->first();
            $wallet->subAmount($order->total_amount, AssetDetails::TYPE_BUY);

            return $order;
        });

        return response()->json(['data' => $order]);
    }

}
