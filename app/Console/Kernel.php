<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use SebastianBergmann\Environment\Console;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     * @var array
     */
    protected $commands = [
//        \App\Console\Commands\SendMail::class,
    ];

    /**
     * Define the application's command schedule.
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $cron_list = Config('cron.cron.cron_list');
        foreach ($cron_list as $key => $value) {
            $type = $value['type'];
            $schedule->command($value['method'])
                ->$type($value['time'])->before(function() use ($value) {
                    Log::info('=====' . $value['method'] . "====开始执行");
                })->after(function() use ($value) {
                    Log::info('=====' . $value['method'] . "====执行完成");
                });
        }
    }

    /**
     * Register the commands for the application.
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
