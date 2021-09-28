<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dcat\Admin\Traits\HasDateTimeFormatter;

class News extends Model
{
    use HasFactory, HasDateTimeFormatter;

    const TYPE_KUAIXUN = 'kuaixun';
    const TYPE_ZIXUN   = 'zixun';
    const TYPE_SHUJU   = 'shuju';
    const TYPE_NOTICE  = 'notice';

    public static $typeMap = [
                self::TYPE_KUAIXUN => '快讯',
                self::TYPE_ZIXUN => '资讯',
                self::TYPE_SHUJU => '数据',
                self::TYPE_NOTICE => '公告',
        ];

    protected $fillable = [
       'title','type','content','looks','created_at','stars'
    ];
}
