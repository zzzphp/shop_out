<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Withdrawal;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncOldWallets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:sync-old-wallets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '同步老平台钱包数据';

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
        $currency_id = 2;
        $users = User::all();
        foreach ($users as $user) {
            (new \App\Services\WalletService())->generateWallets($user);
            $old_user = DB::connection('old_mysql')->table('hz_user')
                ->where('phone', $user->phone)
                ->first();
            if (!$old_user) {
                echo "{$user->name}-{$user->phone}-老用户不存在\n";
                continue;
            }
            $suanli_wallet = DB::connection('old_mysql')->table('hz_wallet_fil')
                ->where('uid', $old_user->id)
                ->first();
            if(!$suanli_wallet) {
                echo "{$user->name}-{$user->phone}-老用户钱包不存在\n";
                continue;
            }
            // 可用资产 = 算力钱包 + 用户钱包
            $asset = add($old_user->fil_available_assets, $suanli_wallet->available_assets);
            // 释放
            $unlock = $suanli_wallet->earnings_unlock;
            // 锁仓
            $lock   = $suanli_wallet->earnings_lock;
            // 提币数量 = 已划转 - 用户钱包可用资产
            $transfer = sub($suanli_wallet->transfer_fil, $old_user->fil_available_assets);

            $wallet = Wallet::query()
                ->where(['type' => Wallet::TYPE_COIN, 'user_id' => $user->id, 'currency_id' =>$currency_id])
                ->first();
            $wallet->amount = $unlock;
            $wallet->lock = $lock;
            $wallet->unlock = $unlock;
            $wallet->frozen_amount = 0;
            $wallet->withdrawal_amount = 0;
            $wallet->save();

            // 同步提币记录
            $logs = DB::connection('old_mysql')->table('hz_wallet_fil_extract')
                ->where('userid', $old_user->id)
                ->where('status', 1)
                ->where('is_extract', 1)
                ->get();
            foreach ($logs as $log) {
                $wallet = Wallet::query()
                    ->where('type' , Wallet::TYPE_COIN)
                    ->where('user_id', $user->id)
                    ->where('currency_id', $currency_id)
                    ->first();
                // 减少钱包 可用资产 ，增加冻结金额
                $wallet->amount = sub($wallet->amount, $log->vol);
                $wallet->frozen_amount = add($wallet->frozen_amount, $log->vol);
                $wallet->save();
                echo "{$user->name} - {$user->phone} {$wallet->amount} 提币\n";
                sleep(1);
                Withdrawal::query()->create([
                    'user_id' => $user->id,
                    'currency_id' => $currency_id,
                    'chain' => 'FIL',
                    'coin_address' => $log->address,
                    'amount'   => $log->vol,
                    'service_charge' => 0.001,
                    'actual_amount' => sub($log->vol, 0.001),
                    'status'   => Withdrawal::STATUS_SUCCESS,
                ]);
            }
            echo "{$user->name} - {$user->phone} {$wallet->amount} 同步完成\n";
        }
    }
}
