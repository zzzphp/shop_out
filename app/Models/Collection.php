<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    const TYPE_BANK = 'bank';
    const TYPE_ALIPAY = 'alipay';
    const TYPE_WEIXIN = 'weixin';

    public static $typeMap = [
        self::TYPE_BANK => '银联',
        self::TYPE_ALIPAY => '支付宝',
        self::TYPE_WEIXIN => '微信',
    ];

    protected $fillable = [
        'type', 'user_id', 'data','hash_key'
    ];

    protected $casts = [
        'data' => 'json',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            // 如果模型的 no 字段为空
            if (!$model->hash_key) {
                // 根据用户ID和币种生成哈希,该哈希是唯一的
                $model->hash_key = hashKey($model->user_id, $model->type);
            }
            $model->data = [];
        });
        static::saving(function($model){
            // 验证hash_key是否一致
            if($model->hash_key !== hashKey($model->user_id, $model->type)) {
                return false;
            }
        });
    }

}
