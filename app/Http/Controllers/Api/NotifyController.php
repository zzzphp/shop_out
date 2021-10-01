<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AssetDetails;
use App\Models\Recharge;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yansongda\LaravelPay\Facades\Pay;

class NotifyController extends Controller
{
    //
    public function alipayRechargeNotify(Request $request)
    {
        $result = Pay::alipay()->callback();
        if (!in_array($result->get('trade_status'), ['TRADE_SUCCESS', 'TRADE_FINISHED'])) {
            return Pay::alipay()->success();
        }
        $recharge = Recharge::find($result->get('out_trade_no'));
        if (!$recharge) {
            Log::error($result);
            return 'fail';
        }
        // 如果该充值已经确认 避免多次通知重复执行该代码
        if ($recharge->status !== Recharge::STATUS_PENDING) {
            return Pay::alipay()->success();
        }
        DB::transaction(function () use ($recharge, $result){
            $recharge->status = $result->get('trade_status') === 'TRADE_SUCCESS' ?
                                                           Recharge::STATUS_SUCCESS : Recharge::STATUS_FALED;
            $recharge->recharge_prove = $result->get('trade_no');
            $recharge->save();
            if ($recharge->status == Recharge::STATUS_SUCCESS) {
                $wallet = Wallet::query()
                    ->where(['user_id' => $recharge->user_id,
                        'currency_id' => $recharge->currency_id,
                        'type'     => Wallet::TYPE_LEFAL,
                    ])->first();
                $wallet->addAmount($result->get('total_amount'), AssetDetails::TYPE_RECHARGE);
            } else {
                Log::error($result);
            }
        });
        return Pay::alipay()->success();
    }
}
