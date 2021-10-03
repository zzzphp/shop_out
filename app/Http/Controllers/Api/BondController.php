<?php

namespace App\Http\Controllers\Api;

use App\Models\AssetDetails;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BondController extends Controller
{
    //
    public function pay_bond(Request $request)
    {
        $request->validate(['amount' => 'required', 'safe_password' => 'required']);
        $safe_password = DB::table('users')
            ->where('id', $request->user()->id)
            ->value('safe_password');
        if (!Hash::check($request->safe_password, $safe_password)) {
            return $this->errorResponse(400, '安全密码错误');
        }
        DB::transaction(function () use ($request){
            $wallet = Wallet::query()
                ->where('user_id', $request->user()->id)
                ->where('currency_id', 1)
                ->first();
            $bond = config('site.bond');
            $amount = $bond * $request->amount;
            $wallet->addBondAmount($amount);
            $wallet->subAmount($amount, AssetDetails::TYPE_BOND);
        });
        return response()->json(['data' => $wallet]);
    }

    public function bond(Request $request)
    {
        $wallet = Wallet::query()
            ->where('user_id', $request->user()->id)
            ->where('currency_id', 1)
            ->first();
        $bond = config('site.bond');
        $data['every_bond'] = $bond;
        $data['max'] = 1;
        $data['total_bond'] = add($wallet->bond, $wallet->lock) / $bond;
        $data['leftover_bond'] = $wallet->bond / $bond;

        return response()->json(['data' => $data]);
    }
}
