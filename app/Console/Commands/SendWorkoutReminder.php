<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Notifications\WorkoutReminderNotification;
use Illuminate\Support\Facades\Log;

class SendWorkoutReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:workout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send workout reminders to users';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('🏋️‍♂️ Workout Reminder Command Ran at ' . now());

        $users = User::all();
        foreach ($users as $user) {
            $user->notify(new WorkoutReminderNotification());
        }

        $this->info('Workout reminders sent to all users!');
    }
}
