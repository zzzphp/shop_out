<?php

namespace App\Observers;

use App\Models\Order;
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
        if ($order->status === Order::STATUS_PENDING && $order->paid_at) {
            noticeHelper(['scene' => "单 ID:{$order->id} 付款", 'name' => $order->user->name, 'phone' => $order->user->phone]);
        }
        if ($order->status === Order::STATUS_SUCCESS) {
            // 模板消息通知用户
            $user = $order->user;
            if ($user->openid) {
                $official = Facade::officialAccount();
                $official->template_message->send([
                    'touser' => $user->openid,
                    'template_id' => 'uYUboRC69ule_Xy8Bm8HM9z4VR8cov-zhLof7Otj0uo',
                    'url'   => 'https://g.gaogecloud.com/#/pages/orderlist/index?id=1&=&status=success',
                    'data' => [
                        'first' => "恭喜您！购买的商品已支付成功",
                        'keyword1' => $order->no,
                        'keyword2' => $order->product->title,
                        'keyword3' => $order->total_amount . ' ￥',
                        'keyword4' => Order::$statusMap[$order->status],
                        'keyword5' => $order->created_at,
                        'remark'   => '高歌云',
                    ],
                ]);
            }
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
