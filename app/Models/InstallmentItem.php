<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class InstallmentItem extends Model
{
    use HasFactory,HasDateTimeFormatter;

    const REFUND_STATUS_PENDING = 'pending';
    const REFUND_STATUS_PROCESSING = 'processing';
    const REFUND_STATUS_SUCCESS = 'success';
    const REFUND_STATUS_FAILED = 'failed';

    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_SUCCESS = 'success';
    const STATUS_FAILED = 'failed';

    public static array $statusMap = [
        self::STATUS_PENDING => '待支付',
        self::STATUS_PROCESSING => '审核中',
        self::STATUS_SUCCESS => '支付成功',
        self::STATUS_FAILED => '支付失败',
    ];

    public static array $refundStatusMap = [
        self::REFUND_STATUS_PENDING => '未退款',
        self::REFUND_STATUS_PROCESSING => '退款中',
        self::REFUND_STATUS_SUCCESS => '退款成功',
        self::REFUND_STATUS_FAILED => '退款失败',
    ];

    protected $fillable = [
        'sequence',
        'base',
        'due_date',
        'paid_at',
        'payment_method',
        'pay_prove',
        'refund_status',
    ];
    protected $dates = ['due_date', 'paid_at'];

    protected $appends = [
        'pay_prove_url',
    ];

    public function getPayProveUrlAttribute()
    {
        if (Str::startsWith($this->attributes['pay_prove'], ['http://', 'https://'])) {
            return $this->attributes['pay_prove'];
        }
        return Storage::disk('admin')->url($this->attributes['pay_prove']);
    }

    public function installment()
    {
        return $this->belongsTo(Installment::class);
    }

    // 创建一个访问器，返回当前还款计划是否已经逾期
    public function getIsOverdueAttribute()
    {
        return Carbon::now()->gt($this->due_date);
    }
}
