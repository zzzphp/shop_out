<?php

namespace App\Console\Commands;

use App\Models\AssetDetails;
use App\Models\Category;
use App\Models\Order;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ThawBondCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:thaw-bond';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '每场结束后释放未使用的保证金';

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
        // 定时解冻所有保证金
//        $now = date('H' , time());
//        $hours = ['8', '14', '17'];
//        foreach ($hours as $hour) {
//            if ($hour == $now) {
        $wallets = Wallet::query()
                    ->where('currency_id', 1)
                    ->where('bond', '>', 0)
                    ->get();
        foreach ($wallets as $wallet) {
            DB::transaction(function () use ($wallet){
                // 获取未完成的订单数
                $count = Order::query()
                    ->where('user_id', $wallet->user_id)
                    ->whereIn('status', [Order::STATUS_PENDING, Order::STATUS_RELEASE, Order::STATUS_LOCK])
                    ->count();
                $bond = $wallet->bond - ($count * config('site.bond'));
                $wallet->addAmount($bond, AssetDetails::TYPE_BOND_RETURN);
                $wallet->subBondAmount($bond);
            });
        }
//            }
//        }
    }
}
