<?php

namespace App\Console\Commands;

use App\Models\AssetDetails;
use App\Models\Loan;
use App\Models\LoanDetailed;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class LoansCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'loands:loands-deduction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '借贷每日自动扣款';

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
        $today = Carbon::today()->toDateString();
        $result = Loan::query()
            ->where(['status' => Loan::STATUS_PENDING])
            ->where('to_be_returned', '>', 0)
            ->where('last_dated', '<>', $today)
            ->chunk(400, function ($loans) use ($today){
                foreach ($loans as $loan) {
                    // 根据流水获取该用户今天的收益
                    $today_asstet = AssetDetails::query()
                        ->where(['user_id' => $loan->user_id, 'currency_id' => $loan->currency_id])
                        ->where(function ($builder){
                            $builder->where('type', AssetDetails::TYPE_POWER)
                                    ->orWhere('type', AssetDetails::TYPE_RELEASE);
                        })
                        ->whereDate('created_at', $today)
                        ->sum('amount');
                    // 开启事务
                    DB::transaction(function () use ($today_asstet, $loan, $today){
                        // 计算本次扣款 和 利息
                        $amount = mul($today_asstet, $loan->profit_rate/100); // 本次还款
                        $interest = mul($loan->to_be_returned, $loan->interest_rate/100); // 利息
                       // 获取用户钱包
                        $wallet = Wallet::query()
                            ->where(['user_id' => $loan->user_id, 'currency_id' => $loan->currency_id])
                            ->first();
                        // 钱包可用资产是否小于本次扣款，如果小于 则先扣除利息
                        if ($wallet->amount < add($amount, $interest)) {
                            // 利息不变，可用资产 - 利息 = 最大数量
                            $amount = sub($wallet->amount, $interest);
                        }
                        // 扣除钱包的资产
                        $wallet->amount = sub($wallet->amount, add($amount, $interest));
                        $wallet->save();
                        // 增加本次还款 次数、利息 减少待还
                        $loan->to_be_returned = sub($loan->to_be_returned, $amount);
                        $loan->already_interest = add($loan->already_interest, $interest);
                        $loan->count = $loan->count + 1;
                        $loan->last_dated = $today;
                        $loan->save();
                        // 还款记录
                        LoanDetailed::query()->create([
                            'user_id' => $loan->user_id,
                            'currency_id' => $loan->currency_id,
                            'loan_id'  => $loan->id,
                            'to_be_returned' => $loan->to_be_returned,
                            'interest'   => $interest,
                            'total_amount' => $today_asstet,
                            'amount'   => $amount,
                            'profit_rate' => $loan->profit_rate,
                            'interest_rate' => $loan->interest_rate,
                            'dated' => $today,
                        ]);
                    });
                }
            });
            echo $result;
    }
}
