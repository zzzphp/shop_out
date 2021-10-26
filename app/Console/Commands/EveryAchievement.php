<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Shop;
use App\Models\ShopsAchievement;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class EveryAchievement extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:every-achievement';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '每天统计业绩';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date = Carbon::yesterday()->toDateString();
        Shop::query()
            ->whereNotNull('admin_id')
            ->chunk(100, function ($shops) use ($date){
                foreach ($shops as $shop) {
                    $user = User::query()->where('admin_id', $shop->admin_id)->pluck('id');
                    $model = ShopsAchievement::query()
                        ->firstOrNew(['admin_id' => $shop->admin_id, 'dated' => $date]);
                    $model->data = Order::query()
                        ->whereDate('paid_at', $date)
                        ->whereIn('user_id', $user)
                        ->whereNotIn('status', [Order::STATUS_PENDING, Order::STATUS_FAILED, Order::STATUS_RELEASE, Order::STATUS_LOCK])
                        ->pluck('id');
                    $model->total_amount = Order::query()->whereIn('id', $model->data)->sum('total_amount');
                    $model->save();
                }
            });
    }
}
