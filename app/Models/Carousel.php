<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Carousel extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name','image','link',
    ];
    
    protected $appends = [
        'image_url'
    ];
    
    public function getImage()
    {
        if (Str::startsWith($this->attributes['image'], ['http://', 'https://'])) {
            return $this->attributes['image'];
        }
        return Storage::disk('admin')->url($this->attributes['image']);
    }
    
    public function getImageUrlAttribute()
    {
        if (Str::startsWith($this->attributes['image'], ['http://', 'https://'])) {
            return $this->attributes['image'];
        }
        return Storage::disk('admin')->url($this->attributes['image']);
    }
}
