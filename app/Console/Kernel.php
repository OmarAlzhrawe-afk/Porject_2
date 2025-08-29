<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('report:library')->monthlyOn(1, '12:00');
        $schedule->command('report:financial')->monthlyOn(1, '12:00');
        $schedule->command('report:students')->monthlyOn(1, '12:00');
        $schedule->command('report:teacher')->monthlyOn(1, '12:00');
        $schedule->command('educationlevel:checkfully')->dailyAt('08:00');
        $schedule->command('activities:check-seats')->dailyAt('08:00');
        $schedule->command('salaries:generate')->monthlyOn(1, '12:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
