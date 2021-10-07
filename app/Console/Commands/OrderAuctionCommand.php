<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
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
            ->whereDate('created_at', Carbon::yesterday()->toDateString())
            ->where('status', Order::STATUS_SELL)
            ->where('closed', false)
            ->chunk(200, function ($orders){
                foreach ($orders as $order) {
                    DB::transaction(function () use ($order){
//                        dd($order);
                        $new_product = $order->product->replicate();
                        // 手续费
                        $service_charge = mul($new_product->price, config('site.service_charge'));
                        // 溢价
                        $premium = mul($new_product->price, config('site.premium'));
                        $new_product->user_id =$order->user_id;
                        $new_product->original_price =$order->price;
                        $new_product->stock =$order->amount;
                        $new_product->type = Product::TYPE_AUCTION;
                        $new_product->price = add($new_product->price, add($premium, $service_charge));
                        $new_product->save();
                        $order->status = Order::STATUS_BUY;
                        $order->save();
                    });
                }
            });
    }
}
