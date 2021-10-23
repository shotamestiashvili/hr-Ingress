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


        if($att_in == 0 && $att_out == 0){

            $this->att_inHour     = 0;
            $this->att_inMin      = 0;
            $this->att_outHour    = 0;
            $this->att_outMin     = 0;

        }elseif($att_in == 0 ){

            $this->att_inHour     = 0;
            $this->att_inMin      = 0;

            $expOut    =  explode(':', $att_out);

            $this->att_outHour    = (int)$expOut[0];
            $this->att_outMin     = (int)$expOut[1];

        }elseif($att_out == 0 ){


            $this->att_outHour    = 0;
            $this->att_outMin     = 0;

            $expIn     =  explode(':', $att_in);

            $this->att_inHour     = (int)$expIn[0];
            $this->att_inMin      = (int)$expIn[1];


        }else {

            $expIn     =  explode(':', $att_in);
            $expOut    =  explode(':', $att_out);

            $this->att_inHour     = (int)$expIn[0];
            $this->att_inMin      = (int)$expIn[1];
            $this->att_outHour    = (int)$expOut[0];
            $this->att_outMin     = (int)$expOut[1];
        }

    }
}
