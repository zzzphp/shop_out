<?php


namespace App\Services;


use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class UserService
{

    public function team(User $user)
    {
        $data = [];
        $data['name'] = $user->name;
        $data['phone'] = $user->phone;
        $data['self_amount'] = Order::query()
            ->where('user_id', $user->id)
            ->sum('total_amount');
        $user_ids = $this->team_amount($user);
        $data['team_amount'] = Order::query()
                        ->whereIn('user_id', $user_ids)
                        ->sum('total_amount');
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
