<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributeLog extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id', 'distribute_id', 'amount'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function distribute()
    {
        return $this->belongsTo(Distribute::class);
    }
    
}


