<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PowerDistribute;
use Illuminate\Support\Carbon;
use App\Jobs\FirstDistribute;

class FirstCurrency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'miners:first-powers-currency';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '每日首次分发算力';

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
        
        // 首次分发条件，昨日日期、状态为未发放
        $yesterday = Carbon::yesterday()->toDateString();
        //$yesterday = '2021-05-19';
        $distributes = PowerDistribute::where(['status' => PowerDistribute::STATUS_NONE, 'dated' => $yesterday])->get();
        // dd($distributes);
        foreach ($distributes as $distribute) {
            // 将每个任务放到队列
            FirstDistribute::dispatch($distribute);
        }
        echo count($distributes)."\n";
    }
}
