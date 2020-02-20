<?php

namespace App\Console;

use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

          $todayDate = Carbon::now()->setTimezone('Asia/Dhaka')->format('Y-m-d');

        $schedule->call(function () {
            DB::table('appointments')
            ->where('date','<',Carbon::now()->setTimezone('Asia/Dhaka')->format('Y-m-d'))
            ->where('status', 'approved')
            ->orWhere('status', 'pending')
            ->update(['status' => 'incomplete']);
        })->daily();
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
