<?php

namespace App\Jobs;

use App\Models\AssetDetails;
use App\Models\Currency;
use App\Models\Distribute;
use App\Models\DistributeLog;
use App\Models\PowerDistribute;
use App\Models\PowerDistributeLog;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class LinearRelease implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        if ($distribute->status !== PowerDistribute::STATUS_PENDING) {
            return;
        }
        $logs = PowerDistributeLog::query()
            ->where('power_distribute_id', $distribute->id)
            ->chunk(400, function ($logs) use ($distribute){
                foreach ($logs as $log) {
                    if ($log->num >= $distribute->line_day) {
                        continue; // 跳过当前循环
                    }
                    DB::transaction(function () use ($log, $distribute){
                        // 首次分发 + 线性释放部分 = 181次
                        $first = mul($distribute->first/100, $log->all); // 首次分发数量
                        $line  = sub($log->all, $first); // 线性释放部分
                        $frontAmount = mul(div($log->num, $distribute->line_day), $line);
                        $nextAmount = mul(div($log->num + 1, $distribute->line_day), $line);
                        // 1-0,2-1,3-2
                        $amount = sub($nextAmount, $frontAmount); // 此次释放的数量
                        // 数据验证（避免超发）
                        if (comp(add($log->unlock, $amount), $log->all)) {
                            $amount = sub($log->all, $log->unlock);
                            $log->lock = $amount;
                        }
                        // 数据验证 （避免少发）
                        if (($log->num + 1)  === $distribute->line_day) {
                            // 最后一次解锁收益 不等于 总收益，则将锁仓的收益 改成本次释放的收益
                            if (comp($log->all, add($log->unlock, $amount))) {
                                $amount = $log->lock;
                            }
                        }
                        // 更改该记录数据
                        $log->num    = $log->num + 1;
                        $log->unlock = add($log->unlock, $amount);
                        $log->lock   = sub(convert_scientific_number_to_normal($log->lock), $amount);
                        $log->save();
                        // 增加用户币种数量
                        // 记录资产明细
                        $currency = Currency::find($log->currency_id);
                        $wallet = Wallet::query()
                            ->where(['user_id'=> $log->user_id, 'currency_id' => $log->currency_id, 'type' => $currency->type])
                            ->first();
                        $after_amount = add($wallet->amount, $amount); // 增加后的可用资产
                        AssetDetails::create([
                            'user_id' => $log->user_id,
                            'currency_id' => $log->currency_id,
                            'front_amount' => $wallet->amount,
                            'amount'  => $amount,
                            'after_amount' => $after_amount,
                            'type'    => AssetDetails::TYPE_RELEASE,
                            'remark'  => '日期:'.$log->dated. '.记录ID:' . $log->id.'.分发ID:'.$log->power_distribute_id . '.期数ID:' . $log->stage_id,
                        ]);
                        // 增加钱包可用资产
                        $wallet->amount = $after_amount;
                        // 增加释放 减少锁仓
                        $wallet->lock = sub($wallet->lock, $amount);
                        $wallet->unlock = add($wallet->unlock, $amount);
                        $wallet->save();
                    });
                }
            });
        $distribute->last_dated = Carbon::createFromTimestamp(strtotime($distribute->last_dated))->addDay()->toDateString();
        $distribute->num = $distribute->num + 1;
        if ($distribute->num > $distribute->line_day) {
            $distribute->status = PowerDistribute::STATUS_COMPLETE;
        }
        $distribute->save();
    }

}
