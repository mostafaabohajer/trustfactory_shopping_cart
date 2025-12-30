<?php

use App\Jobs\SendDailySalesReport;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Jobs\SendLowStockNotification;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::job(new SendDailySalesReport())->dailyAt('08:00')->name('daily-sales-report');
Schedule::job(new SendLowStockNotification())->dailyAt('08:00')->name('low-stock-notification');
