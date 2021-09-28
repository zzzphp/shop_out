<?php

namespace App\Jobs;

use App\Models\Currency;
use App\Models\Wallet;
use App\Services\WalletService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\PowerDistribute;
use Illuminate\Support\Facades\DB;
use App\Models\PowerDistributeLog;
use App\Models\Power;

class FirstDistribute implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $timeout = 600;

    protected $distribute;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(PowerDistribute $distribute)
    {
        //
        $this->distribute = $distribute;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $distribute = $this->distribute;
        if ($distribute->status !== PowerDistribute::STATUS_NONE) {
            return;
        }
            // 找出该期所有有效算力
            $powers = Power::where(['currency_id' => $distribute->currency_id, 'stage_id' => $distribute->stage_id])
            ->where('power', '>', 0)
            ->get();
            foreach ($powers as $power) {
                DB::transaction(function () use ($distribute, $power) {
                        // 如果 是直接释放
                    if($distribute->type === PowerDistribute::TYPE_DIRECT) {
                        // 直接释放所得收益
                        $all = mul($power->power, $distribute->available_assets);
                        PowerDistributeLog::create([
                                'user_id' => $power->user_id,
                                'currency_id' => $power->currency_id,
                                'stage_id'    => $power->stage_id,
                                'power_distribute_id' => $distribute->id,
                                'dated'       => $distribute->dated,
                                'power'       => $power->power,
                                'all'         => $all, // 总收益
                                'unlock'      => $all, // 直接收益 = 总收益
                                'lock'        => sub($all, $all), // 锁仓为0
                            ]);
                        WalletService::addAmount($power->user_id, $power->currency_id, $all);
                        // 直接释放 则释放完成
                        $distribute->status = PowerDistribute::STATUS_COMPLETE;
                    } else {
                        $all = mul($power->power, $distribute->available_assets);
                        $unlock = mul($all, $distribute->first/100);
                        $lock = sub($all, $unlock);
                        PowerDistributeLog::create([
                                'user_id' => $power->user_id,
                                'currency_id' => $power->currency_id,
                                'stage_id'    => $power->stage_id,
                                'power_distribute_id' => $distribute->id,
                                'dated'       => $distribute->dated,
                                'power'       => $power->power,
                                'all'         => $all, // 总收益
                                'unlock'      => $unlock,
                                'lock'        => $lock,
                            ]);
                        $currency = Currency::find($power->currency_id);
                        $wallet = Wallet::query()->where(['user_id' => $power->user_id, 'currency_id' => $power->currency_id, 'type' => $currency->type])->first();
                        $wallet->amount = add($wallet->amount, $unlock);
                        // 增加释放 增加锁仓
                        $wallet->lock = add($wallet->lock, $lock);
                        $wallet->unlock = add($wallet->unlock, $unlock);
                        $wallet->save();
                        // 线性释放
                        $distribute->status = PowerDistribute::STATUS_PENDING;
                        // 释放日期为当天
                        $distribute->last_dated = date('Y-m-d', time());
                    }
                });
            }
            $distribute->num = $distribute->num + 1;
            $distribute->save();
    }

}
