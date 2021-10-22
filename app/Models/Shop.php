<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Shop extends Model
{
	use HasDateTimeFormatter;

    protected $fillable = [
        'collection', 'logo', 'name', 'phone', 'title', 'quota_data'
    ];
	protected $casts = [
	    'collection' => 'json',
        'quota_data'  => 'json',
    ];

	protected $appends = ['logo_url'];


	public function getLogoUrlAttribute()
    {
        if (Str::startsWith($this->attributes['logo'], ['http://', 'https://'])) {
            return $this->attributes['logo'];
        }
        return Storage::disk('admin')->url($this->attributes['logo']);
    }

    public function getCollectionAttribute()
    {
        if(isset($this->attributes['collection']) && $this->attributes['collection']) {
            $data = json_decode($this->attributes['collection'], true);
            foreach ($data as $k => $value) {
                if (!Str::startsWith($value['qrcode'], ['http://', 'https://'])) {
                    $data[$k]['qrcode'] = Storage::disk('admin')->url($value['qrcode']);
                }
            }
            return $data;
        }
    }
}
