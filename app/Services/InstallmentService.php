<?php

namespace App\Services;
use App\Exceptions\InternalException;
use App\Models\Installment;
use App\Models\Order;
use Carbon\Carbon;

class InstallmentService
{
    protected int $count = 12; // 期数
    protected int $interval = 3;  // 还款间隔(月)单位
    protected float $amount = 50; // 每期还款数量

    public function store(Order $order)
    {
        $installment = new Installment([
            'user_id'      => $order->user_id,
            'total_amount' => $this->amount * $this->count,
            'count'        => $this->count,
            'status'       => Installment::STATUS_PENDING
        ]);
        $installment->order()->associate($order);
        $installment->save();
        $dueDate = Carbon::tomorrow();
        for($i = 0; $i < $this->count; $i++) {
            $installment->items()->create([
                'sequence' => $i, //期数
                'base' => $this->amount * $order->amount, //每期还款数量
                'due_date' => $dueDate->toDateString(),
            ]);
            $dueDate = $dueDate->copy()->addMonths($this->interval);
        }
        return $installment;
    }
}
