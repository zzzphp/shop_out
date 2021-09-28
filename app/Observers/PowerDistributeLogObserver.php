<?php

namespace App\Observers;

use App\Models\PowerDistributeLog;
use App\Models\AssetDetails;
use App\Models\Wallet;

class PowerDistributeLogObserver
{
    /**
     * Handle the PowerDistributeLog "created" event.
     *
     * @param  \App\Models\PowerDistributeLog  $powerDistributeLog
     * @return void
     */
    public function created(PowerDistributeLog $powerDistributeLog)
    {
        // dd($powerDistributeLog);
        //
        $wallet = Wallet::query()
            ->firstOrCreate(['user_id'=> $powerDistributeLog->user_id, 'currency_id' => $powerDistributeLog->currency_id, 'type' => Wallet::TYPE_COIN]);
        AssetDetails::create([
            'user_id' => $powerDistributeLog->user_id,
            'currency_id' => $powerDistributeLog->currency_id,
            'front_amount' => $wallet->amount,
            'amount'  => $powerDistributeLog->unlock,
            'after_amount' => add($powerDistributeLog->unlock, $wallet->amount),
            'type'    => AssetDetails::TYPE_POWER,
            'remark'  => '日期:'.$powerDistributeLog->dated. '.记录ID:' . $powerDistributeLog->id.'.分发ID:'.$powerDistributeLog->power_distribute_id . '.期数ID:' . $powerDistributeLog->stage_id,
        ]);
    }

    /**
     * Handle the PowerDistributeLog "updated" event.
     *
     * @param  \App\Models\PowerDistributeLog  $powerDistributeLog
     * @return void
     */
    public function updating(PowerDistributeLog $powerDistributeLog)
    {
        //
        // dd($powerDistributeLog);
    }

    public function saving(PowerDistributeLog $powerDistributeLog)
    {
        // dd($powerDistributeLog);
    }

    /**
     * Handle the PowerDistributeLog "deleted" event.
     *
     * @param  \App\Models\PowerDistributeLog  $powerDistributeLog
     * @return void
     */
    public function deleting(PowerDistributeLog $powerDistributeLog)
    {
        //
    }

    /**
     * Handle the PowerDistributeLog "restored" event.
     *
     * @param  \App\Models\PowerDistributeLog  $powerDistributeLog
     * @return void
     */
    public function restored(PowerDistributeLog $powerDistributeLog)
    {
        //

    }

    /**
     * Handle the PowerDistributeLog "force deleted" event.
     *
     * @param  \App\Models\PowerDistributeLog  $powerDistributeLog
     * @return void
     */
    public function forceDeleted(PowerDistributeLog $powerDistributeLog)
    {
        //
    }
}
