<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    use HasFactory;


    public function agent()
    {
        // 一个代理只有一个账号
        return $this->hasOne(Agent::class);
    }

}
