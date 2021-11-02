<?php

namespace App\Services\Accounting\MSO;

use App\Models\Mso;
use Carbon\Carbon;

class MsoCalculation
{
    public function msoHours($userid, $year, $month)
    {
        $from = Carbon::create($year . '-' . ($month - 1) . '-' . '21');
        $to   = Carbon::create($year . '-' . $month . '-' . '20');

        $getPersonnel = Mso::with('personnel')
            ->where('userid', $userid)
            ->where('type', 1)
            ->whereBetween('enddate', [$from, $to])
            ->get('total_hours');

        $hour = $getPersonnel->map(function ($personnel) {
            $in = explode(':', $personnel->total_hours);
            return $hour = (int)$in[0];
        })->sum();

        $minute = $getPersonnel->map(function ($personnel) {
            $in = explode(':', $personnel->total_hours);
            return $min = (int)$in[1];
        })->sum();

        $hoursFromMin = intdiv($minute, 60) . ':' . ($minute % 60);

        $explodedFromMin = explode(':', $hoursFromMin);
        $hours = $hour + $explodedFromMin[0];
        $minutes = $explodedFromMin[1];

        return ($hours . ':' . $minutes);
    }


    public function msoYearly($userid, $year)
    {
        $getPersonnel = Mso::with('personnel')
         ->where('userid', $userid)
            ->where('type', 1)
            ->whereYear('enddate', $year)
            ->get('total_hours');

        $hour = $getPersonnel->map(function ($personnel) {
            $in = explode(':', $personnel->total_hours);
            return $hour = (int)$in[0];
        })->sum();

        $minute = $getPersonnel->map(function ($personnel) {
            $in = explode(':', $personnel->total_hours);
            return $min = (int)$in[1];
        })->sum();

        $hoursFromMin = intdiv($minute, 60) . ':' . ($minute % 60);

        $explodedFromMin = explode(':', $hoursFromMin);
        $hours = $hour + $explodedFromMin[0];
        $minutes = $explodedFromMin[1];

        return ($hours . ':' . $minutes);
    }
}
