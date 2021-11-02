<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dcat\Admin\Traits\HasDateTimeFormatter;

class ServiceShop extends Model
{
    use HasFactory, HasDateTimeFormatter;

    protected $casts = [
        'recharge_data' => 'json',
    ];
}
