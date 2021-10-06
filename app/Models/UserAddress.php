<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dcat\Admin\Traits\HasDateTimeFormatter;

class UserAddress extends Model
{
    use HasFactory, HasDateTimeFormatter;

    protected $fillable = [
        'province',
        'city',
        'district',
        'address',
        'zip',
        'contact_name',
        'contact_phone',
        'last_used_at',
        'is_default'
    ];

    protected $appends = [
        'full_address'
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    protected $dates = ['last_used_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullAddressAttribute()
    {
        return $this->province.$this->city.$this->district.$this->address;
    }

}
