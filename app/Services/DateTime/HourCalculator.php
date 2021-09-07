<?php

namespace App\Services\DateTime;

use App\Models\Inout;
use App\Models\Worktype;

class HourCalculator
{
    public static function overtime($userid, $date)
    {
        $inout    = Inout::where('date', $date)->where('userid', $userid)->first();

        $hoursArray = ($inout->schedule()->get()->map(function ($schedule) {
            return $schedule->worktype()->value('hours');
        }));
        $hours = DateTimeFormater::time($hoursArray[0]);

        $att_in  = DateTimeFormater::timeFormat(DateTimeFormater::time($inout->att_in));
        $att_out = DateTimeFormater::timeFormat(DateTimeFormater::time($inout->att_out));
        $start   = DateTimeFormater::timeFormat(DateTimeFormater::time($inout->schedule()->value('start')));
        $end     = DateTimeFormater::timeFormat(DateTimeFormater::time($inout->schedule()->value('end')));



        // $differenceIn = $start->diffInHours($att_in);
        // $differenceOut = $att_out->diffInHours($end);

        $in    =  explode(':', $inout->att_in);
        $start =  explode(':', $inout->schedule()->value('start'));

        $inHour    = (int)$in[0];
        $inMin     = (int)$in[1];
        $startHour = (int)$start[0];
        $startMin  = (int)$start[1];

        if ($inHour > $startHour) {
            return 'Delay :' . ($inHour - $startHour).'Hour';
        } elseif ($inHour < $startHour) {
            return 'Overtime :' . ($startHour - $inHour).'Hour';
        } elseif ($inHour == $startHour || $inMin > $startMin) {
            return 'Delay :' . ($inMin - $startMin).'Minutes';
        } elseif ($inHour == $startHour || $inMin < $startMin) {
            return 'Overtime :' . ($inMin - $startMin).'Minutes';
        } elseif ($inHour == $startHour || $inMin == $startMin) {
            return 'in Time';
        }
    }

    public static function delay($userid, $date)
    {
    }
}
