<?php

namespace App\Jobs;

use App\Models\ActiveSchedule;
use App\Models\Schedule;
use App\Models\Worktype;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ScheduleCreatorUpdater implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    private $array;
    private $i;
    private $s;
    private $year;
    private $month;
    private $day;
    private $nextday;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($array, $i, $s, $year, $month)
    {
        $this->array = $array;
        $this->i = $i;
        $this->s = $s;
        $this->year = $year;
        $this->month = $month;

        if ($s === 3){
            $this->day = 1;
        }else{
            $this->day = ($s - 2);
        }

//        $date =  Carbon::create($this->year, $this->month, $this->day, 0));
//        $this->nextday = $date->addDay(1)->toDateString();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->array[0][$this->i][$this->s] !== null){
            $start = Worktype::where('code', $this->array[0][$this->i][$this->s])->value('start');
        }else {
            $start = 0;
        }
        if(Worktype::where('code', $this->array[0][$this->i][$this->s])->value('end') !== null){
            $end = Worktype::where('code', $this->array[0][$this->i][$this->s])->value('end');
        }else {
            $end = 0;
        }

        if (Worktype::where('code', $this->array[0][$this->i][$this->s])->value('in24hours') == 1) {
            Schedule::updateOrCreate(
                [   'userid'        => $this->array[0][$this->i][0],
                    'selectedDay'   => ($this->day),
                    'selectedMonth' => $this->month,
                    'selectedYear'  => $this->year,],
                [   'selectedWorktype' => $this->array[0][$this->i][$this->s],
                    'date'  => date($this->year . '-' . $this->month . '-' . $this->day),
                    'start' => $start,
                    'end'   => $end,]);
            ActiveSchedule::create(
                [   'userid'    => $this->array[0][$this->i][0],
                    'worktype'  => $this->array[0][$this->i][$this->s],
                    'starttime' => $start,
                    'startdate' => ($this->year . '-' . $this->month . '-' . $this->day),
                    'endtime'   => $end,
                    'enddate'   => ($this->year . '-' . $this->month . '-' . $this->day),]);

        } elseif(Worktype::where('code', $this->array[0][$this->i][$this->s])->value('in24hours') == 0) {

            Schedule::updateOrCreate(
                [   'userid'        => $this->array[0][$this->i][0],
                    'selectedDay'   => ($this->day),
                    'selectedMonth' => $this->month,
                    'selectedYear'  => $this->year,],
                [   'selectedWorktype' => $this->array[0][$this->i][$this->s],
                    'date'  => ($this->year . '-' . $this->month . '-' . $this->day),
                    'start' => $start,
                    'end'   => $end,]);

            ActiveSchedule::create(
                [   'userid'    => $this->array[0][$this->i][0],
                    'worktype'  => $this->array[0][$this->i][$this->s],
                    'starttime' => $start,
                    'startdate' => ($this->year . '-' . $this->month . '-' . $this->day),
                    'endtime'   => $end,
                    'enddate'   => Carbon::create($this->year, $this->month, $this->day, 0)->addDay(1)->toDateString(),
                ]
            );
        }
    }
}
