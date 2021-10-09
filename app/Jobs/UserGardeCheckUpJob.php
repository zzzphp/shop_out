<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UserGardeCheckUpJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        //
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        if ($this->user->grade === User::GRADE_ZERO) {
            return;
        }
        $vip_grades = config('site.vip_grade');
        $count = Order::query()
            ->where('user_id', $this->user->id)
            ->count();
        $last = '';
        foreach ($vip_grades as $k => $grade) {
            if ($count >= $grade['condition']) {
                $last = $k;
            } else {
                break;
            }
        }
        $this->user->grade = $last;
        $this->user->save();
    }
}
