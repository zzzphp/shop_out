<?php

namespace App\Console\Commands;

use App\Services\OrderService;
use Illuminate\Console\Command;
use App\Models\Order;
use App\Models\Product;
use App\Models\Miner;
use App\Models\Power;

class ProfitDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'miners:set-profit-date';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '设置收益日期区间';

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
        // 遍历所有支付成功 并且 已设置收益日期 的订单
        Order::where('status', Order::STATUS_SUCCESS)
            ->where('closed', false)
            ->whereNotNull('profit_data')
            ->chunk(200, function($orders){
            $today = date('Y-m-d', time());
            foreach ($orders as $order) {
                if($today === $order->profit_data['begin']) {
                    // 当天是 收益开始日期
                    OrderService::addPowers($order);
                    $order->status = Order::STATUS_EFFECTIVE;
                    $order->save();
                }
            }
        });
        // 遍历所有有效算力 并且 已设置收益日期 的订单
        Order::where('status', Order::STATUS_EFFECTIVE)
            ->where('closed', false)->whereNotNull('profit_data')
            ->chunk(200, function($orders){
            $today = date('Y-m-d', time());
            foreach ($orders as $order) {
                // 结束了 减去过期的算力
                if($today === $order->profit_data['end']) {
                    // 判断该产品是算力产品还是整机
                    OrderService::subPowers($order);
                    $order->status = Order::STATUS_INVALID;
                    $order->save();
                }
            }
        });
    }
}
