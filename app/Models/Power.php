<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dcat\Admin\Traits\HasDateTimeFormatter;

class Power extends Model
{
    use HasFactory, HasDateTimeFormatter;

    protected $fillable = [
        'hash_key',
        'user_id',
        'currency_id',
        'stage_id',
        'power',
    ];

    protected static function boot()
    {
        parent::boot();
        // 监听模型创建时间，写入数据库之前触发
        static::creating(function ($model) {
            // 如果模型的 no 字段为空
            if (!$model->hash_key) {
                // 根据用户ID和币种生成哈希,该哈希是唯一的
                $model->hash_key = hashKey($model->user_id, $model->currency_id, $model->stage_id);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
}
