<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


// Schedule the command to run every night at 11:59 PM
Schedule::command('packages:mark-returns')->dailyAt('23:59');

// Define the artisan command to mark undelivered packages as "returned"
Artisan::command('packages:mark-returns', function () {
    // Find all packages that are still pending and created yesterday
    $updatedCount = Package::where('status', 'pending')
        ->whereDate('created_at', Carbon::yesterday()) // Get orders from the previous day
        ->update(['status' => 'returned']);

    // Log the results
    Log::info("Cron Job Executed: $updatedCount packages marked as returned.");

    // Display a message in the terminal
    $this->info("✅ $updatedCount undelivered packages marked as returned.");
})->describe('Mark all undelivered packages as returned at the end of the day');

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
