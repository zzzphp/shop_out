<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Distribute;
use App\Models\Miner;
use App\Models\DistributeLog;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;

class LssueCurrencyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    
    
    protected $distribute;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Distribute $distribute)
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
        if($distribute->status !== Distribute::STATUS_PENDING) {
            return;
        }
        DB::transaction(function () use ($distribute){
            $info = ''; // 信息;
            $i = 0; // 计数
            // 产品
            $product = $distribute->product();
            // 获取该产品矿机
            $miners = Miner::where('product_id', $distribute->product_id)->get();
            $info .= '共'.count($miners).'位用户,已成功发放';
            // 总矿机数量
            $sumMiner = Miner::where('product_id', $distribute->product_id)->sum('amount');
            // 产量/数量 = 单台产量
            $amount = div($distribute->total_amount, $sumMiner);
            foreach ($miners as $miner) {
                // 该用户分发的数量
                $lssueAmount = mul($amount,$miner->amount);
                DistributeLog::create([
                        'user_id' => $miner->user_id,
                        'distribute_id' => $distribute->id,
                        'amount'    => $lssueAmount,
                    ]);
                    
                // 给用户对应的币种钱包增加金额
                $wallet = Wallet::where(['user_id' => $miner->user_id, 'currency_id' => $miner->currency_id])->first();
                $wallet->amount = add($wallet->amount, $lssueAmount);
                if($wallet->save()) {
                    $i++;
                }
                
            }
            $info .= $i.'位用户';
            $distribute->info = $info;
            $distribute->status = Distribute::STATUS_SUCCESS;
            $distribute->save();
        });
    }
}
