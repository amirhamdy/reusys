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
        // Backups (to Google Drive)
//        $schedule->command('backup:clean')->dailyAt('01:30');
//        $schedule->command('backup:run --disable-notifications')->daily();
//        $schedule->command('backup:run --only-db --disable-notifications')->everySixHours();
//        $schedule->command("backup:run --only-db --only-to-disk=s3")->weeklyOn(6, '7:00');
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
