<?php

namespace App\Console\Commands;

use App\Exceptions\InternalException;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:sync-old-orders';

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
        $stage = 1;
        $mortgage_user = 1.8;
        $mortgage_platform = 4.2;
        $product_id = 6;
        $add_day = 1095;

        $orders = DB::connection('old_mysql')
            ->table('hz_productorder')
            ->where(['status' => 1, 'product_id' => 1, 'is_commission' => 1])
            ->get();
        foreach ($orders as $order) {
            if (Order::query()->where('remark', $order->order_id)->exists()) {
                echo "{$order->order_id}-已下单\n";
                continue;
            }
            $phone = $order->user_phone;
            $user = User::query()->where('phone', $phone)->first();
            if (!$user) {
                echo "{$order->user_name}-用户不存在\n";
                continue;
            }
            // 获取收益日期
            $begin = DB::connection('old_mysql')->table('hz_wallet_distributelog')
                ->where('stage', $stage)
                ->where('userid', $order->userid)
                ->value('dated');
            $end = Carbon::createFromTimestamp(strtotime($begin))->addDays($add_day)->toDateString();
            $profit_data = ['begin' => $begin, 'end' => $end];
            // 设置质押
            $mortgage = ['user' => mul($mortgage_user, $order->suanli), 'platform' => mul($mortgage_platform, $order->suanli)];
            DB::transaction(function() use ($order, $user, $profit_data, $mortgage, $product_id){
                $product = Product::find($product_id);
                $ord = new Order([
                    'amount'      => $order->number,
                    'total_amount' => $order->number * $product->price,
                    'remark'        => $order->order_id,
                    'status'       => Order::STATUS_SUCCESS,
                    'payment_method'  => 'CNY',
                    'paid_at'      => $order->ftime,
                    'paid_prove'   => $order->payevidence_image,
                    'created_at'   => $order->ctime,
                    'profit_data' => $profit_data,
                    'mortgage'    => $mortgage,
                ]);
                $ord->user()->associate($user);
                $ord->product()->associate($product);
                $ord->currency()->associate($product->currency);
                $ord->save();
                return $ord;
            });
            echo "{$order->user_phone}-{$order->user_name}-下单完成\n";
            sleep(1);
        }

    }
}
