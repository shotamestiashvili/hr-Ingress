<?php

namespace App\Services\DateTime;

use Carbon\Carbon;


class DateTimeFormater
{
    public static function date ($date)
    {
        return Carbon::parse($date)->format('Y-m-d');
    }

    public static function time($time)
    {
        return Carbon::parse($time)->format('H:i');
    }

    public static function dateFormat($date)
    {

        return Carbon::createFromFormat('Y-m-d H:i', $date.' '.'12:00');
    }

    public static function timeFormat($time)
    {
        return Carbon::createFromFormat('Y-m-d H:i', '2021-01-01'.' '.$time);
    }

    public static function hourFormat($time)
    {
        return Carbon::createFromFormat('Y-m-d H:i', '2021-01-01'.' '.$time.':'.'00')->format('H:i');
    }

}
