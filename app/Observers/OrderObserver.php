<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\Product;
use EasyWeChatComposer\EasyWeChat;
use Overtrue\LaravelWeChat\Facade;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        //
    }

    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        //
        if ($order->status === Order::STATUS_RELEASE && $order->product->type === Product::TYPE_AUCTION) {
            noticeHelper(['phone' => [$order->product->user->phone], 'data' => [$order->product->title, '拍下付款']]);
        }
        if ($order->status === Order::STATUS_LOCK && $order->product->type === Product::TYPE_AUCTION) {
            noticeHelper(['phone' => [$order->product->user->phone], 'data' => [$order->product->title, '锁单']]);
            noticeHelper(['phone' => [$order->user->phone], 'data' => [$order->product->title, '锁单']]);
        }
    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
