<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribute extends Model
{
    use HasFactory;
    const STATUS_NO_STARTED = 'not_started';
    const STATUS_PENDING = 'pending';
    const STATUS_SUCCESS = 'success';
    const STATUS_FAILED = 'failed';
    
    public static $statusMap = [
            self::STATUS_NO_STARTED => '未开始',
            self::STATUS_PENDING    => '发放中',
            self::STATUS_SUCCESS    => '成功',
            self::STATUS_FAILED     => '失败',
        ];
    
    protected $fillable = [
        'day', 'product_id', 'total_amount','info','status','hash_key',
    ];
    protected static function boot()
    {
        parent::boot();
        // 监听模型创建时间，写入数据库之前触发
        static::creating(function ($model) {
            // 如果模型的 no 字段为空
            if (!$model->hash_key) {
                // 根据用户ID和币种生成哈希,该哈希是唯一的
                $model->hash_key = hashKey('','', $model->product_id.$model->day);
            }
        });
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    
}
