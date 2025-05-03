<?php

use Illuminate\Support\Facades\Schedule;

// use Illuminate\Foundation\Inspiring;
// use Illuminate\Support\Facades\Artisan;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote');



Schedule::command('reminder:water')->everyMinute();
Schedule::command('reminder:workout')->everyMinute();
Schedule::command('reminder:water-intake')->everyMinute();

