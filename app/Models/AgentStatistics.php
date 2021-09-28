<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dcat\Admin\Traits\HasDateTimeFormatter;


class AgentStatistics extends Model
{
    use HasFactory, HasDateTimeFormatter;
    
   protected $fillable = [
        'admin_id','agent_id', 'users_count', 'orders_count', 'amount','payment_type', 'dated',
    ];
    
    public function agent()
    {
       return $this->belongsTo(Agent::class);
    }
    
    

}
