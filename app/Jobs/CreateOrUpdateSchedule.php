<?php

namespace App\Jobs;

use App\Models\Schedule;
use App\Models\Worktype;
use Illuminate\Bus\Queueable;
use Illuminate\Console\Command;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;


class CreateOrUpdateSchedule implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $array;
    private $year;
    private $month;

    public $tries = 25;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($array, $year, $month)
    {
        $this->handle($array, $year, $month);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle($array, $year, $month)
    {
        $countOfUsers = $array[0]->count();
        $countOfDays = $array[0][0]->count();

        for ($i = 1; $i < $countOfUsers; $i++) {

            for ($s = 3; $s < $countOfDays; $s++) {

                ScheduleCreatorUpdater::dispatch($array, $i, $s, $year, $month);
//                    ->delay(now()->addSecond(1));
            }
        }

       Artisan::command('queue:work --daemon');
    }

}
