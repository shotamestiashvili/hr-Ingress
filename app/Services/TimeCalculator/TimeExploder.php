<?php

namespace App\Services\TimeCalculator;


class TimeExploder
{

    public $startHour;
    public $startMin;
    public $endHour;
    public $endMin;


    public function __construct($start, $end)
    {

        if($start == 0  && $end == 0 ){

            $this->startHour     = 0;
            $this->startMin      = 0;
            $this->endHour       = 0;
            $this->endMin        = 0;

        }elseif($start == 0 ){

            $this->startHour     = 0;
            $this->startMin      = 0;

            $expEnd    =  explode(':', $end);

            $this->endHour    = (int)$expEnd[0];
            $this->endMin     = (int)$expEnd[1];

        }elseif($end == 0){

            $this->endHour    = 0;
            $this->endMin     = 0;

            $expStart     =  explode(':', $start);

            $this->startHour     = (int)$expStart[0];
            $this->startMin      = (int)$expStart[1];

        }else{

            $expStart  =  explode(':', $start);
            $expEnd    =  explode(':', $end);


        $this->startHour  = (int)$expStart[0];
        $this->startMin   = (int)$expStart[1];
        $this->endHour    = (int)$expEnd[0];
        $this->endMin     = (int)$expEnd[1];
        }
    }

}
