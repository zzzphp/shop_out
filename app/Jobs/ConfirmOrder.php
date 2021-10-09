<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ConfirmOrder implements ShouldQueue
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
        // 该订单必须为 待放货状态
        if($this->order->status !== Order::STATUS_RELEASE) {
            return;
        }
        $order = $this->order;
        DB::transaction(function () use ($order) {
            $order->status = Order::STATUS_SUCCESS;
            $order->save();
            // 将自己的订单数量减少
            $self_order = Order::find($order->product->origin_order);
            if ($self_order) {
                $self_order->amount = $self_order->amount - $order->amount;
                if ($self_order->amount <= 0) {
                    $self_order->status = Order::STATUS_COMPLETE_SELL;
                }
                $self_order->save();
            }
        });
    }
}
