<?php

namespace App\Services\SickLeave;

use App\Models\SickLeave;
use Carbon\Carbon;

class SickLeaveService
{
    const SickLeaveDays = 15;

    public static function calcMonthlyWaste($userid, $year, $month)
    {
        $from = Carbon::create($year . '-' . ($month - 1) . '-' . '21');
        $to   = Carbon::create($year . '-' . $month . '-' . '21');

        return SickLeave::where('userid', $userid)
            ->whereBetween('leave_date', [$from, $to])
            ->where('leave_type', 'SL')
            ->count();
    }

    public static function calcYearlyWaste ($userid, $year)
    {
        return  SickLeave::whereYear('leave_date', $year)
            ->where('userid', $userid)
            ->where('leave_type', 'SL')
            ->count();
    }

    public static function calcRemainDays($userid, $year)
    {
        return self::SickLeaveDays - self::calcYearlyWaste($userid, $year);
    }
}
