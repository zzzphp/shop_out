<?php

namespace App\Observers;

use App\Models\AssetDetails;
use App\Models\LoanDetailed;
use App\Models\Wallet;

class LoanDetailedObserver
{
    /**
     * Handle the LoanDetailed "created" event.
     *
     * @param  \App\Models\LoanDetailed  $loanDetailed
     * @return void
     */
    public function created(LoanDetailed $loanDetailed)
    {
        //
        $wallet = Wallet::query()
            ->firstOrCreate(['user_id'=> $loanDetailed->user_id, 'currency_id' => $loanDetailed->currency_id, 'type' => Wallet::TYPE_COIN]);
        $amount = add($loanDetailed->amount, $loanDetailed->interest);
        AssetDetails::create([
            'user_id' => $loanDetailed->user_id,
            'currency_id' => $loanDetailed->currency_id,
            'front_amount' => add($wallet->amount, $amount),
            'amount'  => $amount,
            'after_amount' => $wallet->amount,
            'type'    => AssetDetails::TYPE_LOAN,
            'remark'  => $loanDetailed->id . "-利息+还款",
        ]);
    }

    /**
     * Handle the LoanDetailed "updated" event.
     *
     * @param  \App\Models\LoanDetailed  $loanDetailed
     * @return void
     */
    public function updated(LoanDetailed $loanDetailed)
    {
        //
    }

    /**
     * Handle the LoanDetailed "deleted" event.
     *
     * @param  \App\Models\LoanDetailed  $loanDetailed
     * @return void
     */
    public function deleted(LoanDetailed $loanDetailed)
    {
        //
    }

    /**
     * Handle the LoanDetailed "restored" event.
     *
     * @param  \App\Models\LoanDetailed  $loanDetailed
     * @return void
     */
    public function restored(LoanDetailed $loanDetailed)
    {
        //
    }

    /**
     * Handle the LoanDetailed "force deleted" event.
     *
     * @param  \App\Models\LoanDetailed  $loanDetailed
     * @return void
     */
    public function forceDeleted(LoanDetailed $loanDetailed)
    {
        //
    }
}
