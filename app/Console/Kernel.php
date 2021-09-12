<?php

namespace App\Console;

use App\Jobs\InoutRefresh;
use App\Jobs\MonthlyGridFetcher;
use App\Jobs\StatisticsGenerate;
use App\Models\Inout;
use App\Services\TimeCalculator\StatisticGenerator;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

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
        $schedule->job(new MonthlyGridFetcher)->everyTwoMinutes();
        $schedule->job(new InoutRefresh)->everyTwoMinutes();
        $schedule->job(new StatisticsGenerate)->everyFiveMinutes();

        $schedule->command('queue:work --daemon')->everyTwoMinutes();
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
