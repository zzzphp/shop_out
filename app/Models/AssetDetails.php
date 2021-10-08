<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dcat\Admin\Traits\HasDateTimeFormatter;

class AssetDetails extends Model
{
    use HasFactory, HasDateTimeFormatter;//reward

    protected $fillable = [
            'user_id', 'currency_id', 'front_amount', 'amount', 'after_amount', 'type', 'remark', 'sign',
        ];

    protected $appends = ['full_type'];

    const TYPE_POWER = 'power';
    const TYPE_RECHARGE = 'recharge';
    const TYPE_WITHDRAWALS = 'withdrawals';
    const TYPE_REWARD = 'reward';
    const TYPE_RELEASE = 'release';
    const TYPE_LOAN = 'loan';
    const TYPE_PLEDGE = 'pledge';
    const TYPE_PLEDGE_RETURN = 'pledge_return';
    const TYPE_BUY = 'buy';
    const TYPE_FROZEN_RETURN = 'return_frozen';
    const TYPE_BOND = 'bond';
    const TYPE_BOND_RETURN = 'bond_return';
    const TYPE_SERVICE = 'service';

    const SECRET_KEY = 'e3ksp8o921hjdjx6';

    public static $typeMap = [
            self::TYPE_POWER => '算力收益',
            self::TYPE_RECHARGE => '充值',
            self::TYPE_WITHDRAWALS => '提现',
            self::TYPE_REWARD => '佣金奖励',
            self::TYPE_RELEASE => '释放收益',
            self::TYPE_LOAN => '借贷扣款',
            self::TYPE_PLEDGE => '质押扣款',
            self::TYPE_PLEDGE_RETURN => '退还质押币',
            self::TYPE_BUY => '购买产品',
            self::TYPE_FROZEN_RETURN => '冻结退回',
            self::TYPE_BOND => '缴纳保证金',
            self::TYPE_BOND_RETURN => '保证金解冻',
            self::TYPE_SERVICE => '手续费',
        ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }


    protected static function boot()
    {
        parent::boot();
        // 监听模型创建时间，写入数据库之前触发
        static::creating(function ($model) {
            // 拼接所有字段数据 + 时间戳 + 密钥
            $sign = $model->user_id . $model->currency_id . $model->front_amount . $model->amount . $model->after_amount . $model->type . self::SECRET_KEY . time();
            $model->sign = md5($sign);
        });
    }

    public function getFullTypeAttribute()
    {
        return self::$typeMap[$this->attributes['type']];
    }

}
