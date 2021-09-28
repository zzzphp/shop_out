<?php

namespace App\Observers;

use App\Models\Recharge;
use App\Models\Wallet;
use App\Models\AssetDetails;
use Overtrue\EasySms\EasySms;

class RechargeObserver
{
    /**
     * Handle the Recharge "created" event.
     *
     * @param  \App\Models\Recharge  $recharge
     * @return void
     */
    public function created(Recharge $recharge)
    {
        noticeHelper(['scene' => '充值', 'name' => $recharge->user->name, 'phone' => $recharge->user->phone]);
    }

    public function saving(Recharge $recharge)
    {
        if($recharge->status === Recharge::STATUS_SUCCESS) {
            // 通知客户
            $user = $recharge->user;
            if ($user->openid) {
                $official = \Overtrue\LaravelWeChat\Facade::officialAccount();
                $official->template_message->send([
                    'touser' => $user->openid,
                    'template_id' => 'k_NTOI-J_X0pHc9npFOmgN6Y5lpNtcQ6RtKpLez_TQI',
                    'url'     => 'https://g.gaogecloud.com/#/pages/wallet/index',
                    'data'  => [
                        'first' => '充值到账',
                        'keyword1' => $user->phone,
                        'keyword2' => $recharge->amount . ' ' . $recharge->currency,
                        'keyword3' => Recharge::$statusMap[$recharge->status],
                        'remark'   => '充值成功，稍后查看到账情况',
                    ],
                ]);
            }
        }
    }

    /**
     * Handle the Recharge "updated" event.
     *
     * @param  \App\Models\Recharge  $recharge
     * @return void
     */
    public function updated(Recharge $recharge)
    {
        //
    }

    /**
     * Handle the Recharge "deleted" event.
     *
     * @param  \App\Models\Recharge  $recharge
     * @return void
     */
    public function deleted(Recharge $recharge)
    {
        //
    }

    /**
     * Handle the Recharge "restored" event.
     *
     * @param  \App\Models\Recharge  $recharge
     * @return void
     */
    public function restored(Recharge $recharge)
    {
        //
    }

    /**
     * Handle the Recharge "force deleted" event.
     *
     * @param  \App\Models\Recharge  $recharge
     * @return void
     */
    public function forceDeleted(Recharge $recharge)
    {
        //
    }
}
