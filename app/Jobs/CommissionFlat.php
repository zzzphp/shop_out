<?php

namespace App\Jobs;

use App\Models\AssetDetails;
use App\Models\Commission;
use App\Models\Order;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class CommissionFlat implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        //
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // 下单人是否满足条件
        $number = $this->getNumberByID($this->order->user);
        $total_amount = $this->getTotalAmount($number);
        if (count($number) < 30 || $total_amount < 300000)
            return;
        // 判断上级是否满足条件
        $parent = User::find($this->order->user->invite_id);
        $parent_number = $this->getNumberByID($this->order->user);
        $total_amount = $this->getTotalAmount($parent_number);
        if (count($parent_number) < 30 || $total_amount < 300000)
            return;
        // 满足条件
        DB::transaction(function () use ($parent){
            $amount = mul($this->order->total_amount, config('site.flat_rate'));
            $commission = Commission::create([
                'level' => Commission::LEVEL_FLAT,
                'amount' => $amount,
                'user_id'=> $parent->id,
                'order_id' => $this->order->id,
                'status' => Commission::STATUS_SUCCESS,
            ]);
            $wallet = Wallet::where(['user_id'=>$parent->id, 'currency_id'=> 1])
                ->first();
            $wallet->addAmount($commission->amount, AssetDetails::TYPE_REWARD);
        });
    }

    public function getNumberByID(User $user)
    {
        $one = User::query()->where('invite_id', $user->id)->pluck('id')->toArray();
        $two = User::query()->whereIn('invite_id', $one)->pluck('id')->toArray();

        return array_merge($one, $two);
    }

    public function getTotalAmount(array $number)
    {
        return Order::query()
            ->whereIn('user_id', $number)
            ->whereNotIn('status', Order::STATUS_PENDING, Order::STATUS_RELEASE, Order::STATUS_LOCK, Order::STATUS_FAILED)
            ->sum('total_amount');
    }
}
