<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Agent;
use App\Models\Currency;
use App\Models\Order;
use App\Models\User;
use App\Models\AgentStatistics;
use Carbon\Carbon;

class AgentPerformanceStatistics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'agent:performance-statistics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '代理每天业绩统计';

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
        $dated = Carbon::yesterday()->toDateString();
        $day = date('d', time() - 86400);
        Agent::chunk(100, function($agents) use ($dated, $day){
            foreach ($agents as $agent) {
                $user_ids = User::where('admin_id', $agent->admin_id)
                    ->whereDay('created_at', $day)
                    ->pluck('id');
                $oders_count = Order::whereDay('created_at', $day)
                                         ->whereIn('user_id', $user_ids)
                                         ->count();
                $amount = Order::whereDay('created_at', $day)
                                     ->whereIn('user_id', $user_ids)
                                     ->sum('total_amount');
                AgentStatistics::create([
                        'dated' => $dated,
                        'admin_id' => $agent->admin_parent_id,
                        'agent_id' => $agent->id,
                        'users_count' => count($user_ids),
                        'orders_count' => $oders_count,
                        'amount'     => $amount,
                ]);
            }
        });
    }
}
