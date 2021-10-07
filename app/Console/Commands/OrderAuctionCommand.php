<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class OrderAuctionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:order-auction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '处理客户转卖订单';

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
        Order::query()
            ->where('status', Order::STATUS_SELL)
            ->chunk(function ($orders){
                foreach ($orders as $order) {
                    DB::transaction(function () use ($order){

                    });
                }
            });
    }
}
