<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\WalletService;
use App\Models\Wallet;

class WalletsController extends Controller
{
    //
    public function index(Request $request, WalletService $server)
    {
        // 生成用户钱包，防止添加币种后未生成钱包
        $server->generateWallets($request->user());
        $wallets = Wallet::where('user_id', $request->user()->id)
                    ->with('currency')
                    ->whereHas('currency', function($builder){
                        $builder->where('is_show', true);
                    })
                    ->first();
        $data['assets'] = $server->calculationWallets($request->user());
        $data['wallets'] = $wallets;
        return response()->json(['data' => $data]);
    }
}
