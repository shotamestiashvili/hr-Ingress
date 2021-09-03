<?php

namespace App\Services\Statistics;

use Illuminate\Support\Carbon;

class ActualDate {

    public $actualDate;
    public $actualYear;
    public $actualMonth;
    public $actualDay;
    public $actualHour;

    public function __construct(){

        $date = Carbon::now();

        $this->actualDate =  $date->format('Y-m-d H:i:s');
        $this->actualYear = $date->year;
        $this->actualMonth = $date->month;
        $this->actualDay= $date->day;
        $this->actualHour = $date->hour;
        $this->actualMinute = $date->minute;
    }
}
