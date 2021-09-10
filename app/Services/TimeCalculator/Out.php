<?php

namespace App\Services\TimeCalculator;

use App\Http\Interfaces\OutInterface;


class Out implements OutInterface
{
    public function out($userid, $date)
    {

        if (( new TimeService($userid, $date))->lateOut !== 0)
        {
            return ( new TimeService($userid, $date))->lateOut;
            
        } else {

            return ( new TimeService($userid, $date))->earlyOut;
        }
    }
}
