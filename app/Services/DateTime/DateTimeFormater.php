<?php

namespace App\Services\DateTime;

use Carbon\Carbon;


class DateTimeFormater
{
    public static function date ($date)
    {
        return Carbon::parse($date)->format('Y-m-d');
        // return Carbon::createFromFormat('Y-m-d', $date)->format('Y-m-d');
    }

    public static function time($time)
    {
        return Carbon::parse($time)->format('H:i');
    }

}
