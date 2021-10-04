<?php

namespace App\Http\Controllers\Api;

use App\Models\AssetDetails;
use App\Models\Currency;
use App\Models\Order;
use App\Models\UserAddress;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Exceptions\InternalException;
use App\Jobs\CloseOrder;
use function PHPUnit\Framework\callback;

class OrdersController extends Controller
{
    //
    public function store(OrderRequest $request)
    {
        $order = DB::transaction(function() use ($request){
            $product = Product::find($request->product_id);
            $open_time = $product->category->open_time;
            $now = Carbon::now();
            // 判断用户的等级，提前抢单
            $grade_config = config('site.vip_grade');
            $grade = $grade_config[$request->user()->grade];
            if ($grade['minute'] !== 0) {
                $advance_now = strtotime($now->toTimeString());
                // 需要先判断一次 当前时间是否在正常抢单时间内， 如果已经在正常抢单时间，则不需要再去判断提前抢单数量
                if ($advance_now < strtotime($open_time['begin']) || $advance_now > strtotime($open_time['end'])) {
                    // 检查提前抢单时间段是否有订单
                    $advance_time = Carbon::createFromTimeString($open_time['begin'])
                        ->subMinutes($grade['minute'])
                        ->toTimeString();
                    $order_count = Order::query()
                        ->whereDate('created_at', $now->toDateString())
                        ->whereTime('created_at', '>=', $advance_time)
                        ->whereTime('created_at', '<=', $open_time['begin'])
                        ->count();
                    if ($order_count >= $grade['order']) {
                        return $this->errorResponse(400, '您已经超过提前抢单数量');
                    }
                }
                // 根据用户等级增加提前抢单时间
                $now->addMinutes($grade['minute']);
            }
            $now = strtotime($now->toTimeString());
            if ($now < strtotime($open_time['begin']) || $now > strtotime($open_time['end'])) {
                 return $this->errorResponse(400, '抢购时间未开始');
            }
            $address = UserAddress::find($request->address_id);
            $order = new Order([
                'amount'      => $request->amount,
                'payment_price'      => $request->amount * $product->price,
                'total_amount' => $request->amount * $product->price,
                'remark'        => $request->input('remark', ''),
                'status'       => Order::STATUS_PENDING,
                'payment_method'  => 'CNY',
                'total_powers' => $product->amount * $request->amount,
            ]);
            $order->user()->associate($request->user());
            $order->product()->associate($product);
            //减少产品库存
            if($product->decreaseStock($request->amount) <= 0) {
                throw new InternalException("库存不足");
            }
            // 冻结保证金
            $wallet = Wallet::query()
                            ->where('user_id', $request->user()->id)
                            ->where(['currency_id' => 1, 'type' => Currency::TYPE_LEFAL])
                            ->first();
            $amount = $request->amount * config('site.bond');
            $wallet->subBondAmount($amount);
            $wallet->addLockAmount($amount);
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
            // 扣除余额
            $wallet = Wallet::query()
                            ->where('user_id', $order->user_id)
                            ->where(['currency_id' => 1, 'type' => Currency::TYPE_LEFAL])
                            ->first();
            $wallet->subAmount($order->total_amount, AssetDetails::TYPE_BUY);

            $order->save();
            return $order;
        });

        return response()->json(['data' => $order]);
    }

}
