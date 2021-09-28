<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Dcat\Admin\Traits\HasDateTimeFormatter;
use Dcat\Admin\Traits\ModelTree;
use Dcat\Admin\Admin;

class Agent extends Model
{
    use HasFactory, HasDateTimeFormatter, ModelTree;
    
    const TYPE_COMPANY = 'company';
    const TYPE_PERSONAL = 'personal';
    
    
    protected $titleColumn = 'name';

    protected $orderColumn = 'id';

    protected $parentColumn = 'parent_id';
    
    public static $typeMap = [
            self::TYPE_COMPANY => '公司',
            self::TYPE_PERSONAL => '个人',
        ];
        
    protected $fillable = [
        'type','name','address','phone','idcard','image','admin_id','ability','admin_parent_id','parent_id',
    ];
    
    public $casts = [
            'ability' => 'boolean',
    ];
        
    public function admin()
    {
        return $this->belongsTo(AdminUser::class);
    }
    
    public function adminParent()
    {
        return $this->belongsTo(AdminUser::class);
    }
    
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
    
    
    public function getParentIdAttribute()
    {
        // return 1;
        // if(Admin::user()->isRole('agent')) {
        //     $my_agent_id = Agent::where('admin_id', Admin::user()->id)->value('id');
        //     if($my_agent_id === $this->attributes['parent_id']) {
        //         return 0;
        //     }
        // }
        // return $this->attributes['parent_id'];
    }
    
    
}
