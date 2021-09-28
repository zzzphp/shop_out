<?php

namespace App\Http\Controllers\Api;

use App\Models\CurrencyMarketBiki;
use App\Models\Order;
use App\Models\PayMethod;
use Illuminate\Http\Request;

class PayMethodController extends Controller
{
    //
    public function amount(Request $request)
    {
        $request->validate(['order_id' => 'required', 'id' => 'required']);
        $total_amount = 0;
        $order = Order::find($request->order_id);
        $pay_method = PayMethod::find($request->input('id'));
        if ($pay_method->type === PayMethod::TYPE_REAL || $pay_method->type === PayMethod::TYPE_LEGAL) {
            $amount = number_format(ceil($order->total_amount / $pay_method->rate), 2, '.', '');
        }
        // 数字货币
        if ($pay_method->type === PayMethod::TYPE_DIGITAL) {
            // 先转换成 USDT
            $usdt_amount = ceil($order->total_amount/usdtAmount());
            // 获取该币种 最新行情
            $last = CurrencyMarketBiki::query()
                ->where('symbol', strtolower($pay_method->e_name))
                ->value('last');
            // 如果币种不存在则报错
            if (!$last) {
                $this->errorResponse(400, '该支付方式错误，请选择其它方式');
            }
            $amount = round(add(div($usdt_amount, $last), 0.01), 2);
        }

        return response()->json(['data' => $amount]);
    }
}
