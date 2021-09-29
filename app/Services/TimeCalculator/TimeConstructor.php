<?php

namespace App\Services\TimeCalculator;

use App\Models\Inout;
use App\Models\Worktype;
use App\Services\DateTime\DateTimeFormater;


class TimeConstructor extends TimeExploder
{


    public $att_in;
    public $att_out;
    public $start;
    public $end;
    public $worktypeHour;
    public $in24;


    public function __construct($userid, $date)
    {
        $this->timeFetcher($userid, $date);
    }


    public function timeFetcher($userid, $date)
    {
        $inout = Inout::with(['schedule', 'personnel', 'statistic'])
                     ->where('date', $date)
                     ->where('userid', $userid)
                     ->first();



        $this->att_in  = DateTimeFormater::time(($inout->att_in));
        $this->att_out = DateTimeFormater::time($inout->att_out);

        $this->start   = DateTimeFormater::time($inout->schedule()->value('start'));
        $this->end     = DateTimeFormater::time($inout->schedule()->value('end'));

    }

}
