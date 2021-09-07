<?php

namespace App\Services\TimeCalculator;


class AttExploder
{

    public $inHour;
    public $inMin;
    public $outHour;
    public $outMin;


    public function __construct($att_in, $att_out)
    {
        $expIn     =  explode(':', $att_in);
        $expOut    =  explode(':', $att_out);


        $this->inHour     = (int)$expIn[0];
        $this->inMin      = (int)$expIn[1];
        $this->outHour    = (int)$expOut[0];
        $this->outMin     = (int)$expOut[1];

    }
}
