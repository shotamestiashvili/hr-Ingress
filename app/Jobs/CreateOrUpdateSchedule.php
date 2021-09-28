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

    public $tries = 3;

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
        $countOfUsers = $array[0]->count(); // cell of the userid's name
        $countOfDays  = $array[0][0]->count(); //cells of the users, dep and positions


        for ($i = 1; $i < $countOfUsers; $i++) {

            for ($s = 3; $s < $countOfDays; $s++) {

                ScheduleCreatorUpdater::dispatch($array, $i, $s, $year, $month)->delay(now()->addMinute(3));
            }
        }
        Artisan::command('queue:work --daemon --tries=5 --timeout=10', 'OK');
    }

}
