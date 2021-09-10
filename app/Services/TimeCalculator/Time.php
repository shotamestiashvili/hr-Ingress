<?php

namespace App\Services\TimeCalculator;

use App\Http\Interfaces\InInterface;
use App\Http\Interfaces\OutInterface;

class Time
{
    public $in;
    public $out;

    public function in(InInterface $in,  $userid, $date)
    {
        return  $in->In($userid, $date);
    }


    public function out(OutInterface $in,  $userid, $date)
    {
        return  $in->Out($userid, $date);
    }


}
