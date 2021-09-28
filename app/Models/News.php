<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dcat\Admin\Traits\HasDateTimeFormatter;

class News extends Model
{
    use HasFactory, HasDateTimeFormatter;

    const TYPE_HELP = 'help';
    const TYPE_ACTIVE   = 'shuju';
    const TYPE_NOTICE  = 'notice';

    public static $typeMap = [
                self::TYPE_HELP => '帮助中心',
                self::TYPE_ACTIVE => '活动',
                self::TYPE_NOTICE => '公告',
        ];

    protected $fillable = [
       'title','type','content','looks','created_at','stars'
    ];
}
