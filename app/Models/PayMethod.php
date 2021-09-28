<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PayMethod extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'pay_method';

    const TYPE_REAL     = 'real';
    const TYPE_DIGITAL  = 'digital';
    const TYPE_LEGAL    = 'legal';
    public static $typeMap = [
        self::TYPE_REAL       => '货币',
        self::TYPE_DIGITAL    => '数字货币',
        self::TYPE_LEGAL      => '数字法币',
    ];

    protected $appends = [
        'icon_url',
    ];

    protected $casts = [
        'info' => 'json',
        'real_info' => 'json',
    ];

    public function getIconUrlAttribute()
    {
        if (Str::startsWith($this->attributes['icon'], ['http://', 'https://'])) {
            return $this->attributes['icon'];
        }
        return Storage::disk('admin')->url($this->attributes['icon']);
    }
}
