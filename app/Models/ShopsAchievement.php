<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopsAchievement extends Model
{
    use HasFactory;

    protected $fillable = ['admin_id', 'total_amount', 'dated', 'data'];

    protected $casts = [
        'data' => 'json',
    ];

}
