<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class DistributesAutomatic extends Model
{
    const TYPE_LINE = 'line';
    const TYPE_DIRECT = 'direct';

    public static $typeMap = [
        self::TYPE_LINE => '线性释放',
        self::TYPE_DIRECT => '直接释放',
    ];

	use HasDateTimeFormatter;
    protected $table = 'distributes_automatic';

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
