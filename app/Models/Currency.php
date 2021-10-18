<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Currency extends Model
{
    use HasFactory;

    const TYPE_LEFAL = 'legal';
    const TYPE_COIN = 'coin';

    public static $typeMap = [
            self::TYPE_LEFAL => '法币',
            self::TYPE_COIN =>  '币币',
    ];

    protected $fillable = [
        'name','description','address_data','icon','chains','is_show',
    ];

    protected $casts = [
        'address_data' => 'json',
        'chains'       => 'json',
        'is_show'      => 'boolean',
    ];

    protected $appends = [
        'wallet_amount'
    ];

    public function getWalletAmountAttribute()
    {
        if (auth('api')->check()) {
            return Wallet::query()
                ->where(['user_id' => auth('api')->id(), 'currency_id' => $this->attributes['id']])
                ->value('amount');
        }
    }

    public function getIcon()
    {
        if (Str::startsWith($this->attributes['icon'], ['http://', 'https://'])) {
            return $this->attributes['icon'];
        }
        return Storage::disk('admin')->url($this->attributes['icon']);
    }

    public function getAddressDataAttribute()
    {
        if($this->attributes['address_data']) {
            $data = json_decode($this->attributes['address_data'], true);
            foreach ($data as $k => $value) {
                if (!Str::startsWith($value['qrcode'], ['http://', 'https://'])) {
                    $data[$k]['qrcode'] = Storage::disk('admin')->url($value['qrcode']);
                }
            }
            return $data;
        }
    }

    public function chainConf($chain_name) {
        $chains = json_decode($this->attributes['chains'], true);
        foreach ($chains as $chain) {
            if(strtoupper($chain['chain']) === strtoupper($chain_name)) {
                return $chain;
            }
        }
    }

    public function rechargeConf($chain_name)
    {
        $chains = json_decode($this->attributes['address_data'], true);
        foreach ($chains as $chain) {
            if(strtoupper($chain['chain']) === strtoupper($chain_name)) {
                return $chain;
            }
        }
        return [];
    }

//    public function chains()
//    {
//        return $this->hasMany(CurrencyChain::class);
//    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function miners()
    {
        return $this->hasMany(Miner::class);
    }

    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }

}
