<?php

namespace App\Http\Controllers\Api;

use App\Models\Currency;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Recharge;
use Illuminate\Support\Facades\DB;
use Yansongda\LaravelPay\Facades\Pay;

class RechargesController extends Controller
{
    // 充币
    public function store(Request $request)
    {
        $user = User::find(1);
        $request->validate([
                'amount'         => 'required',
                'currency_id'    => 'required',
                'type'           => 'required',
            ]);
        $currency = Currency::find($request->currency_id);
        DB::beginTransaction();
        $recharge = Recharge::create([
            'user_id'  => $user->id,
            'currency' => $currency->name,
            'chain'    => $request->type,
            'amount'   => $request->amount,
            'recharge_prove' => $request->recharge_prove,
            'currency_id'   => $request->currency_id,
        ]);
        $result = '';
        switch ($request->type) {
            case '支付宝':
                $result = Pay::alipay()->wap([
                    'out_trade_no' => $recharge->id,
                    'total_amount' => $recharge->amount,
                    'subject'      => 'shop',
                    'notify_url'   => config('app.url') . '/api/v1/payment/alipay/return',
                ])->getBody()->getContents();
                return $result;
                break;
            default:
                $this->errorResponse(400, '当前支付方式未开通');
                DB::rollBack();
                break;
        }
        DB::commit();

        return response()->json(['data' => $result]);
    }

    public function index(Request $request)
    {
        $builder = Recharge::query();
        $builder->where('user_id', $request->user()->id);
        if($currency_id = $request->input('currency_id', '')) {
            $builder->where('currency_id', $currency_id);
        }
        return response()->json(['data' => $builder->get()]);
    }
}
