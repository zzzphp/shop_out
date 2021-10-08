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
use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\callback;

class OrdersController extends Controller
{
    //
    public function store(OrderRequest $request)
    {
        $order = DB::transaction(function() use ($request){
            $address = UserAddress::find($request->address_id);
            if (!$address) return $this->errorResponse(400, '请完善收货地址');
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
            $total_amount = $request->amount * $product->price;
            // 手续费
            $order = new Order([
                'amount'      => $request->amount,
                'payment_price'      => $total_amount,
                'total_amount' => $total_amount,
                'remark'        => $request->input('remark', ''),
                'status'       => Order::STATUS_PENDING,
                'payment_method'  => 'CNY',
                'total_powers' => $product->amount * $request->amount,
                'address'     => $address->toArray(),
                'collection' => $request->collection,
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
            // 从保证金中 扣除手续费
            $wallet->addLockAmount($amount);
            $order->save();
           return $order;
        });
        // 延时队列关闭未支付的订单
        dispatch(new CloseOrder($order, config('app.order_ttl')));
        return response()->json(['data' => $order]);
    }

    public function index(Request $request)
    {
        $builder = Order::query()
        ->orderBy('id','desc')
        ->with(['product']);
        if ($request->input('status', '')) {
            switch ($request->status) {
                case '0':
                    $builder->where('user_id', $request->user()->id)
                    ->whereIn('status', [Order::STATUS_SUCCESS,
                                                        Order::STATUS_PENDING,
                                                        Order::STATUS_FAILED
                        ]);
                    break;
                case Order::STATUS_RELEASE:
                        $builder->where('status' , Order::STATUS_RELEASE)
                                ->whereHas('product', function ($query) use ($request){
                                    $query->where('user_id', $request->user()->id);
                                });
//                case Order::STATUS_COMPLETE_SELL:
//                    $builder->where('status' , Order::STATUS_SUCCESS)
//                        ->whereHas('product', function ($query) use ($request){
//                            $query->where('user_id', $request->user()->id)
//                                ->whereNotNull('paid_at');
//                        });
//                    break;
                default:
                    $builder->where('user_id', $request->user()->id)
                    ->where('status', $request->input('status'));
                    break;
            }
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
            'paid_prove' => 'required',
        ]);
        $order = Order::find($request->input('id'));
        $this->authorize('own', $order);
        if ($order->closed)
            $this->errorResponse(400, '订单已关闭，请重新下单！');
        if ($order->status !== Order::STATUS_PENDING) {
            $this->errorResponse(400, '订单状态不正确');
        }
        $order = DB::transaction(function () use ($order, $request){
            $order->paid_prove = $request->paid_prove;
            $order->payment_method = '转账';
            $order->payment_price = $order->total_amount;
            $order->status = Order::STATUS_RELEASE;
            $order->paid_at = Carbon::now()->toDateTimeString();
            $order->save();
            return $order;
        });
        return response()->json(['data' => $order]);
    }

    public function auction_pay(Request $request)
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
            return $order;
        });
    }

    public function apply_goods(Request $request)
    {
        $request->validate(['order_id' => 'required']);
        $order = Order::find($request->order_id);
        if ($order->status !== Order::STATUS_SUCCESS) {
            return $this->errorResponse(400, '该订单状态不正确');
        }
        $this->authorize('own', $order);
        $order->status = Order::STATUS_WAIT_GOODS;

        return response()->json(['data' => $order->save()]);
    }

    public function apply_sell(Request $request)
    {
        $request->validate(['order_id' => 'required', 'safe_password' => 'required']);
        $order = Order::find($request->order_id);
        // 确认支付密码
        $safe_password = DB::table('users')
            ->where('id', $request->user()->id)
            ->value('safe_password');
        if (!Hash::check($request->safe_password, $safe_password)) {
            return $this->errorResponse(400, '安全密码错误');
        }
        // 从余额扣除手续费
        if ($order->status !== Order::STATUS_SUCCESS) {
            return $this->errorResponse(400, '该订单状态不正确');
        }
        $this->authorize('own', $order);
        $order = DB::transaction(function () use ($order){
            $order->status = Order::STATUS_SELL;
            $order->save();
            // 从余额扣除手续费
            $wallet = Wallet::query()
                ->where('user_id', $order->user_id)
                ->where('currency_id', 1)
                ->first();
            $wallet->subAmount(mul($order->total_amount, config('site.service_charge')), AssetDetails::TYPE_SERVICE);
            return $order;
        });

        return response()->json(['data' => $order]);
    }

    public function release_goods(Request $request)
    {
        // 放货，确认付款
        $request->validate(['order_id' => 'required']);
        DB::transaction(function () use ($request) {
            // 更改订单状态为支付成
            $order = Order::find($request->order_id);
            if ($order->status !== Order::STATUS_RELEASE) {
                return $this->errorResponse(400, '订单状态不正确');
            }
            $order->status = Order::STATUS_SUCCESS;
            $order->save();
            // 将自己的订单数量减少
            $self_order = Order::find($order->product->origin_order);
            if ($self_order->status !== Order::STATUS_SELL) {
                return $this->errorResponse(400, '订单状态不正确');
            }
            $self_order->amount = $self_order->amount - $order->amount;
            if ($self_order->amount <= 0) {
                $self_order = Order::STATUS_COMPLETE_SELL;
            }
            $self_order->save();
        });
        return response()->json(['data' => true]);
    }

}
