<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dcat\Admin\Traits\HasDateTimeFormatter;

class PowerDistribute extends Model
{
    use HasFactory,HasDateTimeFormatter;

    const STATUS_NONE = 'none';
    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETE = 'complete';

    const TYPE_LINE = 'line';
    const TYPE_DIRECT = 'direct';

    public static $statusMap = [
            self::STATUS_NONE => '未发放',
            self::STATUS_PENDING => '释放中',
            self::STATUS_COMPLETE => '发放完成',
        ];
    public static $typeMap = [
            self::TYPE_LINE => '线性释放',
            self::TYPE_DIRECT => '直接释放',
        ];

    protected $fillable = [
        'hash_key',
        'currency_id',
        'stage_id',
        'dated',
        'available_assets',
        'mortgage_advance',
        'mortgage_user',
        'num',
        'last_dated',
        'status',
        'type',
        'first',
        'line_day',
    ];

    protected static function boot()
    {
        parent::boot();
        // 监听模型创建时间，写入数据库之前触发
        static::creating(function ($model) {
            // 如果模型的 no 字段为空
            if (!$model->hash_key) {
                //该哈希是唯一的
                $model->hash_key = hashKey($model->stage_id, $model->currency_id, $model->dated);
            }
        });
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
