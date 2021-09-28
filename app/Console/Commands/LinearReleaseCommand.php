<?php

namespace App\Console\Commands;

use App\Jobs\LinearRelease;
use App\Models\PowerDistribute;
use Carbon\Carbon;
use Illuminate\Console\Command;

class LinearReleaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'miners:powers-linear-release';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '线性释放';

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
        $today = Carbon::today()->toDateString();
        PowerDistribute::query()
            ->where(['type' => PowerDistribute::TYPE_LINE, 'status' => PowerDistribute::STATUS_PENDING])
            ->whereDate('last_dated', $today)
            ->whereRaw('num <= line_day')
            ->chunk(100, function ($distributes){
                foreach ($distributes as $distribute) {
                    LinearRelease::dispatch($distribute);
                    echo $distribute->id.'-';
                }
            });
    }
}
