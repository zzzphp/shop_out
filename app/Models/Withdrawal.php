<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dcat\Admin\Traits\HasDateTimeFormatter;

class Withdrawal extends Model
{
    use HasFactory, HasDateTimeFormatter;

    const STATUS_PENDING = 'pending';
    const STATUS_SUCCESS = 'success';
    const STATUS_FAILED = 'failed';

    public static $statusMap = [
            self::STATUS_PENDING => '审核中',
            self::STATUS_SUCCESS => '提币成功',
            self::STATUS_FAILED  => '已驳回',
        ];

    protected $fillable = [
        'chain',
        'coin_address',
        'amount',
        'service_charge',
        'actual_amount',
        'status',
        'currency_id',
        'user_id',
        'remark'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }


}
