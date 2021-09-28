<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Power;
use App\Models\PowerDistribute;
use App\Models\PowerDistributeLog;
use App\Models\User;
use App\Services\OrderService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SyncDistributes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:sync-old-distributes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $stage_id = 1;
        $stage = 2;
        $currency_id = 3;
        $dated = Carbon::createFromDate(2021, 01, 10);
        $users = User::all();
        while ($dated->lt(Carbon::today())) {
            foreach ($users as $user) {
                $day = $dated->toDateString();
                // 同步算力
                //$this->profitDate($user, $day);
                $old_user = DB::connection('old_mysql')
                    ->table('hz_user')
                    ->where('phone', $user->phone)
                    ->first();
                if (!$old_user) {
                    echo "{$user->name}-老平台未发现该用户\n";
                    continue;
                }
                // 迁移分发日期
                $old_distribute = DB::connection('old_mysql')
                    ->table('hz_wallet_distribute')
                    ->where(['dated' => $day, 'stage' => $stage])
                    ->first();

                if (PowerDistribute::query()->where([
                    'currency_id' => $currency_id,
                    'stage_id' => $stage_id,
                    'dated' => $day,
                ])->exists()) {
                    $power_distribute = PowerDistribute::query()->where([
                        'currency_id' => $currency_id,
                        'stage_id' => $stage_id,
                        'dated' => $day,
                    ])->first();
                    PowerDistribute::query()->where([
                        'currency_id' => $currency_id,
                        'stage_id' => $stage_id,
                        'dated' => $day,
                    ])->update(['num' => $old_distribute->num + 1,'available_assets' => $old_distribute->available_assets,'last_dated' => $old_distribute->last_dated,'status' => ($old_distribute->num + 1) >= 181 ? PowerDistribute::STATUS_COMPLETE : PowerDistribute::STATUS_PENDING]);

                } else {
                    // 创建分发
                    $power_distribute = PowerDistribute::query()->create([
                        'currency_id' => $currency_id,
                        'stage_id' => $stage_id,
                        'dated' => $day,
                        'available_assets' => $old_distribute->available_assets,
                        'num' => $old_distribute->num + 1,
                        'last_dated' => $old_distribute->last_dated,
                        'status' => ($old_distribute->num + 1) >= 181 ? PowerDistribute::STATUS_COMPLETE : PowerDistribute::STATUS_PENDING,
                        'type' => PowerDistribute::TYPE_LINE,
                        'first' => 25,
                        'line_day' => 180,
                    ]);
                    echo "create_distribute!!!\n";
                }
                $old_log = DB::connection('old_mysql')
                    ->table('hz_wallet_distributelog')
                    ->where(['distributeid' => $old_distribute->id, 'userid' => $old_user->id])
                    ->first();

                if(!$old_log) {
                    echo "{$user->name}-老平台没有该收益记录\n";
                    continue;
                }

                $power = Power::query()->where(['user_id' => $user->id, 'currency_id' => $currency_id, 'stage_id' => $stage_id])->value('power');
                if ($old_log->suanli != $power) {
                    $info =  "{$user->name} - {$user->phone} - {$old_log->dated} - old:{$old_log->suanli} - new:{$power} 算力不正确！！\n";
                    Log::info("powers", ['info' => $info]);
                    echo $info;
                }
                if (PowerDistributeLog::query()->where([
                    'user_id' => $user->id,
                    'currency_id' => $currency_id,
                    'stage_id' => $stage_id,
                    'power_distribute_id' => $power_distribute->id,
                    'dated' => $day,
                ])->exists()) {
                    //echo "{$day} - {$user->name} 分发Log已存在\n";
                    PowerDistributeLog::query()->where([
                        'user_id' => $user->id,
                        'currency_id' => $currency_id,
                        'stage_id' => $stage_id,
                        'power_distribute_id' => $power_distribute->id,
                        'dated' => $day,
                    ])->update(['power' => $old_log->suanli,
                        'all' => $old_log->all,
                        'lock' => $old_log->lock,
                        'unlock' => $old_log->available_assets,
                        'num' => $old_distribute->num]);
                    echo "{$day} - {$user->name} updated\n";
                    //usleep(100000);
                    continue;
                }
                $log = PowerDistributeLog::query()->create([
                    'user_id' => $user->id,
                    'currency_id' => $currency_id,
                    'stage_id' => $stage_id,
                    'power_distribute_id' => $power_distribute->id,
                    'dated' => $day,
                    'power' => $old_log->suanli,
                    'all' => $old_log->all,
                    'lock' => $old_log->lock,
                    'unlock' => $old_log->available_assets,
                    'num' => $old_distribute->num,
                ]);
                echo "{$user->name} - {$user->phone} success！\n";
                // 获取分发记录
//                sleep(1);
                //usleep(100000);
            }
            sleep(2);
            $dated->addDay();
            echo $dated->toDateString() . "开始迁移\n";
        }
    }


    public function profitDate($user, $day)
    {
        // 遍历所有支付成功 并且 已设置收益日期 的订单
        Order::query()->where('status', Order::STATUS_SUCCESS)
            ->where('closed', false)
            ->where('user_id', $user->id)
            ->whereNotNull('profit_data')
            ->chunk(200, function($orders) use ($day, $user){
                foreach ($orders as $order) {
                    if($day === $order->profit_data['begin']) {
                        // 当天是 收益开始日期
                        OrderService::addPowers($order);
                        $order->status = Order::STATUS_EFFECTIVE;
                        $order->save();
                    }
                }
            });
    }
}
