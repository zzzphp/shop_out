<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dcat\Admin\Traits\HasDateTimeFormatter;

class Recharge extends Model
{
    use HasFactory, HasDateTimeFormatter;

    const STATUS_PENDING = 'pending';
    const STATUS_SUCCESS = 'success';
    const STATUS_FALED   = 'failed';

    public static $statusMap = [
            self::STATUS_PENDING => '确认中',
            self::STATUS_SUCCESS => '充值成功',
            self::STATUS_FALED   => '充值失败',
        ];

    protected $fillable = [
        'currency','chain','amount','recharge_prove','user_id','currency_id'
    ];

    protected $casts = [

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
