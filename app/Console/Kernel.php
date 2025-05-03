<?php

namespace App\Console;

use App\Console\Commands\SendWaterIntakeReminder;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use App\Models\User;
//use App\Jobs\SendWorkoutReminder;
use App\Console\Commands\SendWaterReminder;
use App\Console\Commands\SendWorkoutReminder;

// use SendWorkoutReminder as GlobalSendWorkoutReminder;

// use App\Notifications\WaterReminderNotification;

class Kernel extends ConsoleKernel
{
    /**
     * Register the commands for the application.
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
    protected $commands = [
        SendWaterIntakeReminder::class,
        SendWorkoutReminder::class,
        SendWaterReminder::class,
    ];

    /**
     * Define the application's command schedule.
     */
    // app/Console/Kernel.php

    //$schedule->command('reminder:water')->everyMinute();
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('reminder:water-intake')->everyMinute();

        $schedule->command('reminder:water')->everyMinute();
        $schedule->command('reminder:workout')->everyMinute();
    }
}
