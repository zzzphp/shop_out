<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Dcat\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class UserTeam extends Model
{
	use HasDateTimeFormatter, ModelTree;
    protected $table = 'users';

    protected $appends = ['is_effective', 'info'];

    protected $titleColumn = 'title';

    protected $orderColumn = 'id';

    protected $parentColumn = 'invite_id';

    public function getIsEffectiveAttribute()
    {
        return Order::query()
            ->whereNotNull('paid_at')
            ->where('user_id', $this->attributes['id'])
            ->whereNotIn('status', [Order::STATUS_PENDING, Order::STATUS_FAILED, Order::STATUS_RELEASE, Order::STATUS_LOCK])
            ->exists();
    }

    public function getTitleAttribute()
    {
        return '查看';
    }

    public function getInfoAttribute()
    {
        $id = $this->attributes['id'];
        $one = User::query()->where('invite_id', $id)
            ->whereHas('orders', function ($query){
                $query->whereNotNull('paid_at')
                ->whereNotIn('status', [Order::STATUS_PENDING, Order::STATUS_FAILED, Order::STATUS_RELEASE, Order::STATUS_LOCK]);
            })->pluck('id')->toArray();
        $two = User::query()
            ->whereIn('invite_id', $one)
            ->whereHas('orders', function ($query){
                $query->whereNotNull('paid_at')
                ->whereNotIn('status', [Order::STATUS_PENDING, Order::STATUS_FAILED, Order::STATUS_RELEASE, Order::STATUS_LOCK]);
            })
            ->pluck('id')->toArray();
        return "有效直推" . count($one) . " — 伞下有效用户" . count($two);
    }


}
