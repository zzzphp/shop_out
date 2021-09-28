<?php

namespace App\Console\Commands;

use App\Models\Distribute;
use App\Models\Order;
use App\Models\Power;
use App\Models\PowerDistribute;
use App\Models\PowerDistributeLog;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class LocalSyncOrderPowers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'local:sync-orders-pwoers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '同步平台用户算力到订单';

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
//        $orders = DB::connection('old_mysql')
//            ->table('hz_productorder')
//            ->where(['status' => 1,'is_commission' => 1])
//            ->get();
//        foreach ($orders as $order) {
//            $user = DB::connection('old_mysql')
//                ->table('hz_user')
//                ->where(['phone' => $order->user_phone])
//                ->first();
//            if (!$user) {
//                echo $order->userid. " - ".$order->user_name . "-" . $order->user_phone."\n";
//            }
//        }
//        $orders = Order::query()
//            ->where('currency_id', 2)
//            ->with(['product'])
//            ->whereHas('product', function ($builder){
//                $builder->where('stage_id', 1);
//            })
//            ->get();
//        $orders = Order::query()
//            ->where('currency_id', 3)
//            ->with(['product'])
//            ->whereHas('product', function ($builder){
//                $builder->where('stage_id', 5);
//            })
//            ->get();
//        foreach ($orders as $order) {
//            $mortgage = $order->mortgage;
//            $mortgage['user'] = $order->amount * 7.5;
//            $mortgage['platform'] = 0;
//            $order->mortgage = $mortgage;
//            $order->save();
//        }
        return;
        die;
        // 检查算力和 有效算力是否正确
        $currency_id = 1;
        $stage_id = 1;
        $users = User::all();
        foreach ($users as $user) {
            $order_powers = Order::query()
                ->where(['user_id' => $user->id, 'currency_id' => $currency_id])
                ->where('status', Order::STATUS_EFFECTIVE)
                ->sum('total_powers');
            $power = Power::query()
                ->where(['user_id' => $user->id, 'currency_id' => $currency_id, 'stage_id' => $stage_id])
                ->first();
            if (!$power) {
                continue;
            }
            if (intval($power->power) !== intval($order_powers)) {
                echo "{$user->name} -order:{$order_powers} -powers:{$power->power} - 算力不正确\n";
                sleep(1);
                $logs = PowerDistributeLog::query()
                    ->where('user_id', $user->id)
                    ->where('currency_id', $currency_id)
                    ->where('stage_id', $stage_id)
                    ->where('power', $power->power)
                    ->get();
                foreach ($logs as $log) {
                    // 错误的发放
                    $distribute = PowerDistribute::find($log->power_distribute_id);
                    $amount = mul($distribute->available_assets, $order_powers);
                    $log->all = $amount;
                    $log->unlock = $amount;
                    $log->power = $order_powers;
                    $log->save();
                }
                sleep(1);
                $power->power = $order_powers;
                $power->save();
                echo "有效算力同步完成…………\n";
                sleep(1);
            }
        }
    }
}
