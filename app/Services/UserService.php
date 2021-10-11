<?php


namespace App\Services;


use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use function GuzzleHttp\Psr7\uri_for;

class UserService
{

    public function team(User $user, $date = '')
    {
        $data = [];
        $data['name'] = $user->name;
        $data['phone'] = $user->phone;
        $data['self_amount'] = Order::query()
            ->where('user_id', $user->id)
            ->sum('total_amount');
        $user_ids = $this->team_amount($user);
        $builder = Order::query()
            ->whereNotNull('paid_at')
            ->whereIn('user_id', $user_ids);
        if ($data) {
            $builder->whereDate('paid_at', $date);
        }
        $data['team_amount'] = $builder->sum('total_amount');
        $data['team_count'] = count($user_ids);
        $data['shops'] = Product::query()->where('user_id', $user->id)->count();

        return $data;
    }

    public function team_amount(User $user)
    {
        $one_users = User::query()
            ->where('invite_id', $user->id)
            ->where('status', User::STATUS_SUCCESS)
            ->pluck('id')->toArray();
        $two_users = User::query()
            ->where('status', User::STATUS_SUCCESS)
            ->whereIn('id', $one_users)
            ->pluck('id')->toArray();
        return array_unique(array_merge($one_users, $two_users, [$user->id]));
    }

}
