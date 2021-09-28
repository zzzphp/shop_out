<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    const STATUS_PENDING = 'pending';
    const STATUS_SUCCESS = 'success';

    public static $statusMap = [
        self::STATUS_PENDING  => '还款中',
        self::STATUS_SUCCESS  => '还款完成',
    ];

    protected $fillable = [
        'user_id', 'currency_id', 'total_amount',
        'to_be_returned', 'interest_rate',
        'profit_rate', 'count', 'already_interest',
        'last_dated','status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function getTotalAmountAttribute($value)
    {
        return floatval($value);
    }

    public function getToBeReturnedAttribute($value)
    {
        return floatval($value);
    }

    public function getAlreadyInterestAttribute($value)
    {
        return floatval($value);
    }

}
