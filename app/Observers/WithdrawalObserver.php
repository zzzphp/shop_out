<?php

namespace App\Observers;

use App\Models\Currency;
use App\Models\Withdrawal;
use App\Models\Wallet;
use App\Models\AssetDetails;
use Illuminate\Support\Facades\DB;

class WithdrawalObserver
{
    /**
     * Handle the Withdrawal "created" event.
     *
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return void
     */
    public function created(Withdrawal $withdrawal)
    {
        noticeHelper(['scene' => "【{$withdrawal->currency->name}提现】[数量:{$withdrawal->amount}]",
            'name' => $withdrawal->user->name,
            'phone' => $withdrawal->user->phone]);
    }

    public function saving(Withdrawal $withdrawal)
    {
        if($withdrawal->status === Withdrawal::STATUS_SUCCESS) {
            $user = $withdrawal->user;
            if ($user->openid) {
                $official = \Overtrue\LaravelWeChat\Facade::officialAccount();
                $official->template_message->send([
                    'touser' => $user->openid,
                    'template_id' => 'LPibuu_70Di_x6lXMHGMUZas6YkLzLle9GqRHJKjz80',
                    'url'     => 'https://g.gaogecloud.com/#/pages/wallet/index',
                    'data'  => [
                        'first' => '尊敬的用户您好，您已成功提现',
                        'keyword1' => $withdrawal->amount . ' ' .$withdrawal->currency->name,
                        'keyword2' => $withdrawal->created_at,
                        'keyword3' => Withdrawal::$statusMap[$withdrawal->status],
                        'remark'   => '感谢您的使用。',
                    ],
                ]);
            }
        }
    }

    /**
     * Handle the Withdrawal "updated" event.
     *
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return void
     */
    public function updated(Withdrawal $withdrawal)
    {
        //
    }

    /**
     * Handle the Withdrawal "deleted" event.
     *
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return void
     */
    public function deleted(Withdrawal $withdrawal)
    {
        //
    }

    /**
     * Handle the Withdrawal "restored" event.
     *
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return void
     */
    public function restored(Withdrawal $withdrawal)
    {
        //
    }

    /**
     * Handle the Withdrawal "force deleted" event.
     *
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return void
     */
    public function forceDeleted(Withdrawal $withdrawal)
    {
        //
    }
}
