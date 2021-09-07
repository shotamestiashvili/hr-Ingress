<?php

namespace App\Services\TimeCalculator;


class TimeExploder
{

    protected $startHour;
    protected $startMin;
    protected $endHour;
    protected $endMin;


    public function __construct($start, $end)
    {
        $expStart  =  explode(':', $start);
        $expEnd    =  explode(':', $end);

        $this->startHour  = (int)$expStart[0];
        $this->startMin   = (int)$expStart[1];
        $this->endHour    = (int)$expEnd[0];
        $this->endMin     = (int)$expEnd[1];

    }

}
