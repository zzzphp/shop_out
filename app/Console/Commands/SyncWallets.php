<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PowerDistributeLog;
use App\Models\Wallet;
use App\Models\Commission;

class SyncWallets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wallets:sync-users-wallets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '同步计算收益到用户钱包';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Wallet::chunk(100, function($wallets){
            foreach ($wallets as $wallet) {
                $amount = PowerDistributeLog::where(['user_id' => $wallet->user_id, 'currency_id' => $wallet->currency_id])->sum('unlock');
                // $commissionAmount = Commission::where(['user_id' => $wallet->user_id, 'currency_id' => $wallet->currency_id])->sum('amount');
                $balance = sub(sub($amount, $wallet->frozen_amount), $wallet->withdrawal_amount);
                $wallet->amount = $balance;
                $wallet->save();
            }
        });
    }
}
