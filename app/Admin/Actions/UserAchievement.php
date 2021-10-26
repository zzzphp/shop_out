<?php

namespace App\Admin\Actions;

use App\Models\Order;
use App\Models\PowerDistributeLog;
use App\Models\User;
use Carbon\Carbon;
use Dcat\Admin\Actions\Action;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Dcat\Admin\Support\LazyRenderable;
use Dcat\Admin\Widgets\Table;
use App\Models\Wallet;

class UserAchievement extends LazyRenderable
{

    public function render()
    {
        // 获取ID
        $id = $this->key;
        // 获取伞下用户
        $one_users = User::query()->where('invite_id', $id)->pluck('id')->toArray();
        $two_users = User::query()->whereIn('invite_id', $one_users)->pluck('id')->toArray();
        $user = array_merge($one_users, $two_users);

        $carbon = Carbon::today();
        $achievements = [];
        for ($i = 0; $i < 7; $i++) {
            $carbon->subDay();
            $achievements[$i]['dated'] = $carbon->toDateString();
            $achievements[$i]['total_amount'] = Order::query()
                ->whereDate('paid_at', $achievements[$i]['dated'])
                ->whereIn('user_id', $user)
                ->whereNotIn('status', [Order::STATUS_PENDING, Order::STATUS_FAILED, Order::STATUS_RELEASE, Order::STATUS_LOCK])
                ->sum('total_amount');
        }
        $titles = ['日期', '当日业绩'];
        return Table::make($titles, $achievements);
    }
}
