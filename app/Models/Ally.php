<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dcat\Admin\Traits\HasDateTimeFormatter;

class Ally extends Model
{
    use HasFactory,HasDateTimeFormatter;
    
    const STATUS_PEDING = 'pending';
    const STATUS_AGREE = 'agree';
    const STATUS_REJECT = 'reject';
    
    protected $fillable = [
        'name','phone','address','ability','user_id', 'status'
    ];
    
    protected $casts = [
            'ability' => 'boolean',
    ];
    
    public static $statusMap = [
            self::STATUS_PEDING => '审核中',
            self::STATUS_AGREE  => '同意',
            self::STATUS_REJECT => '已驳回',
        ];
        
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
