<?php

namespace App\Services\PaidLeave;

use App\Models\PaidLeave;
use Carbon\Carbon;

class PaidLeaveService
{
    const PaidLeaveDays = 24;

    public static function calcMonthlyWaste($userid, $year, $month)
    {
        $from = Carbon::create($year . '-' . ($month - 1) . '-' . '21');
        $to   = Carbon::create($year . '-' . $month . '-' . '21');

         return PaidLeave::where('userid', $userid)
            ->whereBetween('leave_date', [$from, $to])
            ->where('leave_type', 'VL')
            ->count();

    }

    public static function calcYearlyWaste ($userid, $year)
    {
        return  PaidLeave::whereYear('leave_date', $year)
            ->where('userid', $userid)
            ->where('leave_type', 'VL')
            ->count();
    }

    public static function calcRemainDays($userid, $year)
    {
        return self::PaidLeaveDays - self::calcYearlyWaste($userid, $year);
    }

}
