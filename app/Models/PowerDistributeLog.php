<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dcat\Admin\Traits\HasDateTimeFormatter;

class PowerDistributeLog extends Model
{
    use HasFactory, HasDateTimeFormatter;
    protected $fillable = [
        'user_id',
        'currency_id',
        'stage_id',
        'dated',
        'power_distribute_id',
        'power',
        'all',
        'lock',
        'unlock',
        'num',
    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function powerDistribute()
    {
        return $this->belongsTo(PowerDistribute::class);
    }

    public function getAllAttribute($value)
    {
        return floatval($value);
    }

    public function getLockAttribute($value)
    {
        return floatval($value);
    }

    public function getUnlockAttribute($value)
    {
        return floatval($value);
    }
}
