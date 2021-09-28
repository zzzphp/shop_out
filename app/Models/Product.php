<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\InternalException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    const TYPE_COMPLETE = 'complete';
    const TYPE_POWER    = 'power';

    public static $typeMap = [
            self::TYPE_COMPLETE => '整机',
            self::TYPE_POWER    => '算力',
        ];


    protected $fillable = [
            'currency_id', 'title', 'description', 'original_price', 'price',
            'attributes', 'detail', 'end_at','commission','type','stage_id','on_sale','agreement_id','pay_methods',
        ];


    protected $casts = [
            'attributes' => 'json',
            'commission' => 'json',
            'pay_methods' => 'json',
            'on_sale'    => 'boolean',
            'installment_data' => 'json',
            'labels' => 'json',
        ];

    protected $appends = [
        'image_url', 'agreement', 'methods','usdt_price'
        ];

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function agreement()
    {
        return $this->belongsTo(Agreement::class);
    }

    public function getUsdtPriceAttribute()
    {
        // 换算 USDT
        return number_format(ceil($this->attributes['price']/usdtAmount()), 2, '.', '');
    }

    public function getMethodsAttribute()
    {
        if ($this->attributes['pay_methods'])
            return PayMethod::query()
                ->whereIn('id', json_decode($this->attributes['pay_methods'], true))
                ->orderBy('sort', 'ASC')
                ->get();
    }

    public function getImage()
    {
        if (Str::startsWith($this->attributes['image'], ['http://', 'https://'])) {
            return $this->attributes['image'];
        }
        return Storage::disk('admin')->url($this->attributes['image']);
    }

    public function getImageUrlAttribute()
    {
        if (Str::startsWith($this->attributes['image'], ['http://', 'https://'])) {
            return $this->attributes['image'];
        }
        return Storage::disk('admin')->url($this->attributes['image']);
    }

    public function getAgreementAttribute()
    {
        return Agreement::find($this->attributes['agreement_id']);
    }




        // 减少库存
    public function decreaseStock($amount)
    {
        // dd($amount);
        if($amount < 0) {
            throw new InternalException("减库存不能小于0");
        }
        return $this->where('id', $this->id)->where('stock', '>=', $amount)
            ->decrement('stock', $amount);
    }

    // 增加库存
    public function addStock($amount)
    {
        if ($amount < 0) {
            throw new InternalException('加库存不可小于0');
        }
        $this->increment('stock', $amount);
    }

    // public function getPriceAttribute()
    // {
    //     $fil = DB::table('currency_market_biki')->where('symbol', 'fil')->value('last') ?: 0;
    //     $price = $fil * 6.5 * 360 * 0.07;
    //     return number_format($price, 2);
    // }
}
