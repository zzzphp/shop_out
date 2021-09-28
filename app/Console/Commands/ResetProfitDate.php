<?php

namespace App\Console\Commands;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ResetProfitDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:reset-profit-date';

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
        $product_id = 6;
        $add_days = 540;
        $orders = Order::query()
            ->where('currency_id', 2)
            ->where('product_id', $product_id)
            ->get();
        foreach ($orders as $order) {
            $carbon = Carbon::createFromTimestamp(strtotime($order->paid_at));
            $begin = $carbon->lt(Carbon::createFromDate(2020, 10, 14)) ? '2020-10-14' : $carbon->toDateString();
            $end = Carbon::createFromTimestamp(strtotime($begin))->addDays($add_days)->toDateString();
            $profit_data = ['begin' => $begin, 'end' => $end];
            $order->profit_data = $profit_data;
            $order->save();
        }
    }
}
