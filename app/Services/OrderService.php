<?php

namespace App\Services;


use App\Models\Miner;
use App\Models\Order;
use App\Models\Power;
use App\Models\Product;
use Carbon\Carbon;

class OrderService
{
    public static function addPowers(Order $order)
    {
        if(!$order->profit_data) {
            return;
        }
        if (!Carbon::today()->between($order->profit_data['begin'], $order->profit_data['end'])) {
            return;
        }
        // 判断该产品是算力产品还是整机
        if($order->product->type === Product::TYPE_COMPLETE) {
            // 划到矿机数量
            $miner = Miner::firstOrNew(['user_id' => $order->user_id, 'currency_id' => $order->currency_id, 'product_id' => $order->product_id]);
            $miner->amount = $miner->amount + $order->amount;
            $miner->save();
        } else {
            // 是算力产品
            $power = Power::firstOrNew(['user_id' => $order->user_id, 'currency_id' => $order->currency_id, 'stage_id' => $order->product->stage_id]);
            $power->power = $power->power + $order->total_powers;
            $power->save();
        }
    }

    public static function subPowers(Order $order)
    {
        // 订单未设置收益日期，并且 算力未生效，直接返回
        if(!$order->profit_data || $order->status !== Order::STATUS_EFFECTIVE) {
            return;
        }
        if($order->product->type === Product::TYPE_COMPLETE) {
            // 划到矿机数量
            $miner = Miner::firstOrNew(['user_id' => $order->user_id, 'currency_id' => $order->currency_id, 'product_id' => $order->product_id]);
            $miner->amount = $miner->amount - $order->amount;
            $miner->save();
        } else {
            // 是算力产品
            $power = Power::firstOrNew(['user_id' => $order->user_id, 'currency_id' => $order->currency_id, 'stage_id' => $order->product->stage_id]);
            $power->power = $power->power - $order->total_powers;
            $power->save();
        }
    }

}
