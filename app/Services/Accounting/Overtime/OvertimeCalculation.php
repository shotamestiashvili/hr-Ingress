<?php

namespace App\Services\Accounting\Overtime;

use App\Models\Mso;
use Carbon\Carbon;

class OvertimeCalculation
{
    public function overtimeHours($userid, $year, $month) : string
    {

        $from = Carbon::create($year . '-' . ($month - 1) . '-' . '21');
        $to   = Carbon::create($year . '-' . $month . '-' . '20');


            $getPersonnel = Mso::where('userid', $userid)
                ->where('type', 2)
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


}
