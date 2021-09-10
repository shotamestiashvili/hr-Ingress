<?php

namespace App\Services\TimeCalculator;


class AttExploder
{

    public $att_inHour;
    public $att_inMin;
    public $att_outHour;
    public $att_outMin;


    public function __construct($att_in, $att_out)
    {
        $expIn     =  explode(':', $att_in);
        $expOut    =  explode(':', $att_out);


        $this->att_inHour     = (int)$expIn[0];
        $this->att_inMin      = (int)$expIn[1];
        $this->att_outHour    = (int)$expOut[0];
        $this->att_outMin     = (int)$expOut[1];

    }
}
