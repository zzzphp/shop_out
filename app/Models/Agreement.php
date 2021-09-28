<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
	use HasDateTimeFormatter;
    
    public function product()
    {
        return $this->hasMany(Product::class);
    }
    
    
}
