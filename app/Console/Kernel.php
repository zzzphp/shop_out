<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
//        $schedule->command('minercloud:sync-currency-market')->everyMinute();
//        $schedule->command('miners:set-profit-date')->dailyAt('01:00');
//        $schedule->command('order:overdue-remind')->dailyAt('00:10');
//        $schedule->command('agent:performance-statistics')->dailyAt('00:30');
//        $schedule->command('miners:first-powers-currency')->dailyAt('00:01');
//        $schedule->command('miners:powers-linear-release')->dailyAt('00:10');
//        // 每晚11点自动写入发币数据
//        $schedule->command('miners:power-distributes-automatic')->dailyAt('23:00');
//        // 抓取资讯数据
//        $schedule->command('customize:news-grab')->everyFiveMinutes();
//        $schedule->command('customize:news-grab-information')->everyThirtyMinutes();
        $schedule->command('user:grade-check')->daily(); // 体验会员检测
        $schedule->command('order:order-auction')->daily(); // 客户转卖
        $schedule->command('user:thaw-bond')->hourly(); // 定时解冻保证金

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
