<?php

namespace App\Http\Controllers\Api;

use App\Models\AssetDetails;
use App\Models\Collection;
use Illuminate\Http\Request;
use App\Models\Currency;
use App\Models\Withdrawal;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;

class WithdrawalsController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
                'chain' => 'required',
                'amount'       => 'required',
                'currency_id'  => ['required', 'exists:currencies,id'],
                'code'         => 'required',
                'key'         => 'required',
                'type'        => 'required',
            ]);
        // 验证收款信息
        $collection = Collection::query()
            ->where('user_id', $request->user()->id)
            ->where('type', $request->type)
            ->first();
        if (!$collection->data) {
            $this->errorResponse(400, '请完善收款信息!');
        }
        // 增加短信验证
        $this->validateSmsCode($request->user()->phone, $request->key, $request->code);

        $currency = Currency::find($request->currency_id);
        $chain = $currency->chainConf($request->chain);
        if(!$chain) {
            $this->errorResponse(400, '链名不存在，请重试！');
        }
        // 验证当前提现是否满足 链最低要求
        if (sub($request->amount, $chain['service_charge']) <= 0) {
            $this->errorResponse(400, '请大于最小提币数量');
        }
        // 验证账户资金是否足够
        $wallet = Wallet::where(['user_id' => $request->user()->id,
            'currency_id' => $request->currency_id,
            'type' => $currency->type,
        ])->first();
        if($wallet->amount < $request->amount) {
            $this->errorResponse(400, '当前可用资产不足');
        }

        $withdrawal = DB::transaction(function () use($request, $chain, $wallet) {
             $withdrawal = Withdrawal::create([
                'user_id' => $request->user()->id,
                'currency_id' => $request->currency_id,
                'chain'   => $chain['chain'],
                'coin_address' => $collection->data,
                'amount'        => $request->amount,
                'service_charge' => $chain['service_charge'],
                'actual_amount' => sub($request->amount, $chain['service_charge']), // 实际到账减去手续费
            ]);
            // 减少钱包 可用资产 ，增加冻结金额
            $wallet->addFrozenAmount($request->amount);
            $wallet->subAmount($request->amount, AssetDetails::TYPE_WITHDRAWALS);
            return $withdrawal;
        });

        return response()->json(['data' => $withdrawal]);
    }

    public function index(Request $request)
    {
        $request->validate([
            'currency_id'  => ['required', 'exists:currencies,id'],
        ]);
        $withdrawals = Withdrawal::query()
        ->where('user_id', $request->user()->id)
        ->where('currency_id', $request->currency_id)
        ->orderBy('id', 'DESC')
        ->get();

        return response()->json(['data' => $withdrawals]);
    }
}
