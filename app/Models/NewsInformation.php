<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsInformation extends Model
{
    use HasFactory, HasDateTimeFormatter;

    protected $fillable = [
        'title','summary', 'content', 'resource', 'resource_url',
        'resource_id','author', 'thumbnail','created_at'
    ];

    protected $appends = ['thumbnail_url'];

    public function getThumbnailUrlAttribute()
    {
        if (Str::startsWith($this->attributes['thumbnail'], ['http://', 'https://'])) {
            return $this->attributes['thumbnail'];
        }
        return Storage::disk('admin')->url($this->attributes['thumbnail']);
    }
}
