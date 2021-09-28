<?php

namespace App\Console\Commands;

use App\Models\InstallmentItem;
use App\Models\Miner;
use App\Models\Order;
use App\Models\Power;
use App\Models\Product;
use App\Services\OrderService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class OverdueRemind extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:overdue-remind';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '订单逾期提醒';

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
        $due_date = Carbon::now();
        InstallmentItem::query()
            ->whereNull('paid_at')
            ->whereBetween('due_date', [$due_date->subDay()->toDateString(), $due_date->addDays(2)->toDateString()])
            ->chunk(200,function ($items) use ($due_date){
                foreach ($items as $item) {
                    // 提醒用户尽快还款
                    // ……
                    $order = $item->installment->order;
                    if(Carbon::now()->gt($item->due_date) && $order->status === Order::STATUS_EFFECTIVE) {
                        DB::transaction(function () use ($order){
                            // 大于还款日则过期 并且 订单算力在有效期内
                            // 扣除该订单算力，停止收益发放
                            OrderService::subPowers($order);
                            // 更改订单为逾期状态
                            $order->status = Order::STATUS_OVERDUE;
                            $order->save();
                        });
                    }
                }
        });
    }
}
