<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class CloseOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $order;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order, $delay)
    {
        //
        $this->order = $order;
        $this->delay($delay);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // 判断对应的订单是否已经被支付
        // 如果被支付则不需要关闭，直接退出
        if($this->order->paid_at) {
            return;
        }
        DB::transaction(function (){
            $this->order->update(['closed' => true]);
            $this->order->product->addStock($this->order->amount);
            if (Order::query()->where('user_id', $this->order->user_id)->count() >= 2) {
                User::query()
                    ->where('id', $this->order->user_id)
                    ->update(['is_ban' => true]);
            }
        });
    }
}
