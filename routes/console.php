<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


// Clean expired database cache every hour
Schedule::command('cache:prune-stale')
    ->everyFiveMinutes();

Schedule::command('queue:work')
    ->everyTenSeconds()
    ->withoutOverlapping();
