<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Dcat\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Category extends Model
{
	use HasDateTimeFormatter, ModelTree;

    protected $titleColumn = 'name';

    protected $orderColumn = 'id';

    protected $parentColumn = 'parent_id';

	protected $casts = [
	    'is_show' => 'boolean',
        'open_time' => 'json',
    ];



//	protected $appends = ['icon_url'];

//	public function getIconUrlAttribute()
//    {
//        if (!isset($this->attributes['icon'])) {
//            return;
//        }
//        if (Str::startsWith($this->attributes['icon'], ['http://', 'https://'])) {
//            return $this->attributes['icon'];
//        }
//        return Storage::disk('admin')->url($this->attributes['icon']);
//    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }



}
