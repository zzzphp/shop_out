<?php
namespace App\Services;

use App\Models\AssetDetails;
use App\Models\PowerDistribute;
use App\Models\User;
use App\Models\Currency;
use App\Models\Wallet;

class WalletService
{
    public function generateWallets(User $user)
    {
        foreach (Currency::cursor() as $currency) {
            $hashKey = hashKey($user->id, $currency->id, $currency->type);
            Wallet::firstOrCreate([
                    'hash_key'    => $hashKey,
                    'user_id'     => $user->id,
                    'currency_id' => $currency->id,
                    'type'        => $currency->type,
                ]);
        }
    }

    public static function calculationWallets(User $user)
    {
        $assets = [];
        $total_amount = 0;
        foreach (Currency::cursor() as $currency) {
            $hashKey = hashKey($user->id, $currency->id, $currency->type);
            $wallet = Wallet::firstOrCreate([
                    'hash_key'    => $hashKey,
                    'user_id'     => $user->id,
                    'currency_id' => $currency->id,
                    'type'        => $currency->type,
                ]);
            $total_amount = $total_amount + $wallet->amount * currency_last(strtolower($currency->name)) * usdtAmount();
        }
        $assets['cny'] = number_format($total_amount, 2);
        // 换算为btc
        $assets['btc'] = div(div($total_amount, usdtAmount()), currency_last('btc')) . 'BTC';

        return $assets;
    }

    public static function addAmount($user_id, $currency_id, $amount, $detail_type = '', $remark = '')
    {
        $currency = Currency::find($currency_id);
        $wallet = Wallet::query()->where(['user_id' => $user_id, 'currency_id' => $currency_id, 'type' => $currency->type])->first();
        $afer_amount = add($wallet->amount, $amount);
        if ($detail_type) {
            // 增加流水
            AssetDetails::query()->create([
                'user_id' => $user_id,
                'currency_id' => $currency_id,
                'front_amount' => $wallet->amount,
                'amount' => $amount,
                'after_amount' => $afer_amount,
                'type' => $detail_type,
                'remark' => $remark,
            ]);
        }
        $wallet->amount = $afer_amount;
        $wallet->save();
    }




}
