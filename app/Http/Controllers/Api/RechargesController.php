<?php

namespace App\Http\Controllers\Api;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Models\Recharge;

class RechargesController extends Controller
{
    // 充币
    public function store(Request $request)
    {
        $request->validate([
                'currency'       => 'required',
                'chain'          => 'required',
                'amount'         => 'required',
                'recharge_prove' => 'required|url',
                'currency_id'    => 'required',
            ]);
        $currency = Currency::find($request->currency_id);
        $chain = $currency->rechargeConf($request->chain);
        if (!isset($chain['service_charge']) || !$chain['service_charge']) {
            $chain['service_charge'] = 0;
        }
        $recharge = Recharge::create([
                'user_id'  => $request->user()->id,
                'currency' => $request->currency,
                'chain'    => $request->chain,
                'amount'   => sub($request->amount, $chain['service_charge']),
                'recharge_prove' => $request->recharge_prove,
                'currency_id'   => $request->currency_id,
            ]);
        return response()->json(['data' => $recharge]);
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
