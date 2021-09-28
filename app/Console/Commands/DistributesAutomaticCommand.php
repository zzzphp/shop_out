<?php

namespace App\Console\Commands;

use App\Models\DistributesAutomatic;
use App\Models\PowerDistribute;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DistributesAutomaticCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'miners:power-distributes-automatic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '自动计算发币';

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
        $tasks = DistributesAutomatic::query()->whereDate('dated', Carbon::today()->toDateString())->get();
        foreach ($tasks as $task) {
            $formula = str_replace('$', $task->amount, $task->formula);
            $result = eval("return $formula;");
            echo PowerDistribute::query()->updateOrCreate([
                'type'        => $task->type,
                'first'       => $task->first,
                'line_day'    => $task->line_day,
                'currency_id' => $task->currency_id,
                'stage_id'    => $task->stage_id,
                'dated'       => $task->dated,
                'available_assets' => $result,
                'status'      => PowerDistribute::STATUS_NONE,
            ]);
            $task->dated = Carbon::tomorrow()->toDateString();
            $task->save();
        }
    }
}
