<?php

namespace App\Jobs;

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
        //
        DB::transaction(function () {
            // 下单用户
            $order_user = User::find($this->order->user_id);
            // 产品
            $product = Product::find($this->order->product_id);
            // 佣金参数
            $commission = $product->commission;
            // 该产品未设置分佣
            if(!$commission) {
                return;
            }
            // 该用户没有邀请人直接退出
            if(!$order_user->invite_id) {
                return;
            }
            // 一级用户
            $oneUser = User::find($order_user->invite_id);
            //一级分佣
            Commission::create([
                    'level' => Commission::LEVEL_ONE,
                    'amount' => $commission['one_level'],
                    'user_id'=> $oneUser->id,
                    'order_id' => $this->order->id,
                    'status' => Commission::STATUS_SUCCESS,
            ]);
            // 钱包增加余额
            $wallet = Wallet::where(['user_id'=>$oneUser->id, 'currency_id'=>$commission['reward_currency']])->first();
            $wallet->amount = add($wallet->amount, $commission['one_level']);
            $wallet->save();
            /**************************/
            if(!$oneUser->invite_id) {
                return;
            }
            $twoUser = User::find($oneUser->invite_id);
            // 二级分佣
            $wallet = Wallet::where(['user_id'=>$twoUser->id, 'currency_id'=>$commission['reward_currency']])->first();
            Commission::create([
                    'level' => Commission::LEVEL_TWO,
                    'amount' => $commission['two_level'],
                    'user_id'=> $twoUser->id,
                    'order_id' => $this->order->id,
                    'status' => Commission::STATUS_SUCCESS,
            ]);
            // 钱包增加余额
            $wallet = Wallet::where(['user_id'=>$twoUser->id, 'currency_id'=>$commission['reward_currency']])->first();
            $wallet->amount = add($wallet->amount, $commission['two_level']);
            $wallet->save();
            /*************************/
        });
    }
}
