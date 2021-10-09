<?php

namespace App\Jobs;

use App\Models\AssetDetails;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Commission;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;

class CommissionOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $order;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        //
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // 溢价比例
        $premium = config('site.premium');
        // 卖家用户
        $order_user = User::find($this->order->user_id);
        // 产品
        $product = Product::find($this->order->product_id);
        // 本次收益
        $profit = mul($product->original_price, $premium);
        // 该用户没有邀请人直接退出
        if(!$order_user->invite_id) {
            return;
        }
        $oneUser = User::find($order_user->invite_id);
        // 一级
        DB::transaction(function () use ($oneUser, $profit){
            // 获取账号设置的佣金比例
            $rate = $oneUser->share_rate;
            $one = $rate['one'] ?? 10 / 100;
            //一级分佣
            $commission = Commission::create([
                'level' => Commission::LEVEL_ONE,
                'amount' => mul($profit, $one),
                'user_id'=> $oneUser->id,
                'order_id' => $this->order->id,
                'status' => Commission::STATUS_SUCCESS,
            ]);
            // 钱包增加余额
            $wallet = Wallet::where(['user_id'=>$oneUser->id, 'currency_id'=> 1])
                ->first();
            $wallet->addAmount($commission->amount, AssetDetails::TYPE_REWARD);
        });
        /**************************/
        if(!$oneUser->invite_id) {
            return;
        }
        DB::transaction(function () use ($oneUser, $profit){
            $twoUser = User::find($oneUser->invite_id);
            $rate = $twoUser->share_rate;
            $two = $rate['two'] ?? 10 / 100;
            // 二级分佣
            $commission = Commission::create([
                'level' => Commission::LEVEL_TWO,
                'amount' => mul($profit, $two),
                'user_id'=> $twoUser->id,
                'order_id' => $this->order->id,
                'status' => Commission::STATUS_SUCCESS,
            ]);
            $wallet = Wallet::where(['user_id' => $twoUser->id, 'currency_id' => 1])->first();
            // 钱包增加余额
            $wallet->addAmount($commission->amount, AssetDetails::TYPE_REWARD);
        });
        /*************************/
    }
}
