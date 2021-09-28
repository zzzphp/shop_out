<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dcat\Admin\Traits\HasDateTimeFormatter;

class NewsInformation extends Model
{
    use HasFactory, HasDateTimeFormatter;

    protected $fillable = [
        'title','summary', 'content', 'resource', 'resource_url',
        'resource_id','author', 'thumbnail','created_at'
    ];
}
