<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dcat\Admin\Traits\HasDateTimeFormatter;

class Commission extends Model
{
    use HasFactory, HasDateTimeFormatter;

    const LEVEL_ONE = 'one';
    const LEVEL_TWO = 'two';
    const LEVEL_FLAT = 'flat';
    const LEVEL_TEAM = 'team';

    const STATUS_SUCCESS = 'success';
    const STATUS_REFUND = 'refund';

    public static $statusMap = [
            self::STATUS_SUCCESS => '结佣成功',
            self::STATUS_REFUND  => '已退佣金',
        ];

    public static $levelMap = [
            self::LEVEL_ONE => '直推佣金',
            self::LEVEL_TWO => '二级佣金',
            self::LEVEL_FLAT => '平级佣金',
            self::LEVEL_TEAM => '团队佣金',
        ];

    protected $fillable = [
        'level','amount','user_id','order_id','status','currency_id',
    ];

    protected $appends = [
        'full_status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullStatusAttribute()
    {
        return self::$statusMap[$this->attributes['status']];
    }
}
