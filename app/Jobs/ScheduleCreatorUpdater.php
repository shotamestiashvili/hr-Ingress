<?php

namespace App\Jobs;

use App\Models\Schedule;
use App\Models\Worktype;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ScheduleCreatorUpdater implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 25;

    private $array;
    private $i;
    private $s;
    private $year;
    private $month;

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

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Schedule::updateOrCreate(
            ['userid' => $this->array[0][$this->i][0], 'selectedDay' => ($this->s - 2)],
            ['selectedWorktype' => $this->array[0][$this->i][$this->s ],
                'selectedMonth' => $this->month,
                'selectedYear' => $this->year,
                'date' => $this->year . '-' . $this->month . '-' . ($this->s-2),
                'start' => Worktype::where('code', $this->array[0][$this->i][$this->s])->value('start'),
                'end'   => Worktype::where('code', $this->array[0][$this->i][$this->s])->value('end'),]
        );

    }
}
