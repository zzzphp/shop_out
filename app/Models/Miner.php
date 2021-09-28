<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Miner extends Model
{
    use HasFactory;
     
    protected $fillable = [
        'amount', 'user_id', 'currency_id','hash_key','product_id',
    ];
    
    
    
    protected static function boot()
    {
        parent::boot();
        // 监听模型创建时间，写入数据库之前触发
        static::creating(function ($model) {
            // 如果模型的 no 字段为空
            if (!$model->hash_key) {
                // 根据用户ID和币种生成哈希,该哈希是唯一的
                $model->hash_key = hashKey($model->user_id, $model->currency_id, $model->product_id);
            }
        });
    }
    

    // 减少矿机数量
    public function decreaseAmount($amount)
    {
        if($amount < 0) {
            throw new InternalException("减矿机数量不能小于0");
        }
        return $this->where('id', $this->id)->where('amount', '>', 0)
            ->decrement('amount', $amount);
    }
    
    // 增加库存
    public function addAmount($amount)
    {
        if ($amount < 0) {
            throw new InternalException('加矿机数量不可小于0');
        }
        $this->increment('amount', $amount);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
