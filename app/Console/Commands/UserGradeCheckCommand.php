<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UserGradeCheckCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:grade-check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '检查用户体验会员';

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
        User::query()
            ->where('grade', User::GRADE_ZERO)
            ->chunk(200, function ($users){
                foreach ($users as $user) {
                    $carbon = Carbon::createFromTimestamp(strtotime($user->apply_at));
                    if ($carbon->addDays(3)->lte(Carbon::today())) {
                        $user->grade = User::GRADE_ONE;
                        $user->save();
                    }
                }
            });
    }
}
