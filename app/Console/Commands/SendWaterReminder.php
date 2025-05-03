<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\WelcomeEmail;
use App\Models\User;

class SendWaterReminder extends Command
{
    // The name and signature of the console command.
    protected $signature = 'reminder:water';

    // The console command description.
    protected $description = 'Send daily water intake reminder email';

    // Execute the console command.
    public function handle()
    {
        try {
            // Get all users from the database
            $users = User::all();

            // Loop through each user and send the reminder email
            foreach ($users as $user) {
                $msg = 'Hey ' . $user->name . '! Time to hydrate. 💧 Keep glowing, champ!';
                $sub = 'Water Intake Reminder';

                // Send email to each user
                Mail::to($user->email)->send(new WelcomeEmail($msg, $sub));

                Log::info('✅ Water reminder mail sent to ' . $user->email . ' at ' . now());
                $this->info('✅ Water reminder sent to ' . $user->email . ' at ' . now());
            }

        } catch (\Exception $e) {
            Log::error('❌ Failed to send water reminder: ' . $e->getMessage());
            $this->error('❌ Error: ' . $e->getMessage());
        }
    }
}
