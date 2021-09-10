<?php

namespace App\Services\TimeCalculator;

use App\Http\Interfaces\InInterface;


class In implements InInterface
{
    public function In ($userid, $date)
    {
        if (( new TimeService($userid, $date))->earlyIn !== 0)
        {
            return ( new TimeService($userid, $date))->earlyIn;
        } else {

            return ( new TimeService($userid, $date))->delayIn;
        }
    }
}
