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

    const TYPE_AUCTION = 'auction';
    const TYPE_ROB    = 'rob';

    public static $typeMap = [
            self::TYPE_AUCTION => '转卖',
            self::TYPE_ROB    => '抢购',
        ];

    protected $fillable = [
            'currency_id', 'title', 'description', 'original_price', 'price',
            'attributes', 'detail', 'end_at','commission','type','stage_id','on_sale',
            'origin_order',
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
        'image_url', 'service_charge','collection','user'
        ];

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUserAttribute()
    {
        $data = [];
        if($this->attributes['type'] === Product::TYPE_AUCTION) {
            $user = User::find($this->attributes['user_id']);

            $data = ['name' => $user->name, 'phone' => $user->phone];
        } else {
            if ($this->attributes['admin_id']) {
                $shop = Shop::query()->where('admin_id', $this->attributes['admin_id'])->first();
                $data = ['name' => $shop->name, 'phone' => $shop->phone];
            } else {
                $data = ['name' => '总馆', 'phone' => '111111111'];
            }
        }
        return $data;
    }

    public function getCollectionAttribute()
    {
        return !$this->attributes['user_id'] ?
            Currency::query()->first()->toArray()
            : Collection::where('user_id', $this->attributes['user_id'])->get()->toArray();
    }

    public function getImage()
    {
        if (Str::startsWith($this->attributes['image'], ['http://', 'https://'])) {
            return $this->attributes['image'];
        }
        return Storage::disk('admin')->url($this->attributes['image']);
    }

    public function getServiceChargeAttribute()
    {
        return mul($this->attributes['original_price'], config('site.service_charge'));
    }

    public function getImageUrlAttribute()
    {
        if (Str::startsWith($this->attributes['image'], ['http://', 'https://'])) {
            return $this->attributes['image'];
        }
        return Storage::disk('admin')->url($this->attributes['image']);
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

}
