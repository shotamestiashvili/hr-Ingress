<?php

namespace App\Jobs;

use App\Models\Inout;
use App\Services\DateTime\DateTimeFormater;
use App\Services\TimeCalculator\StatisticGenerator;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StatisticsGenerate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $today =  (Carbon::now())->toDateTimeString();
        $attendanceServicenew = new StatisticGenerator();
        $attendanceServicenew->generate(DateTimeFormater::date($today));
    }
}
