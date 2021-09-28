<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CurrencyMarketBiki extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'currency_market_biki';

    protected $appends  = [
        'image_url'
    ];

    public function getImageUrlAttribute()
    {
        if (Str::startsWith($this->attributes['image'], ['http://', 'https://'])) {
            return $this->attributes['image'];
        }
        return Storage::disk('admin')->url($this->attributes['image']);
    }

}
