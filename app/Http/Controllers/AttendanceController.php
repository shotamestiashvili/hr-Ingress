<?php

namespace App\Http\Controllers;

use App\Services\Statistics\AttendanceService;

class AttendanceController extends Controller
{
    public function montlyFetcher($userid = 140, $year = 2021, $month = 9)
    {
        $attendanceServicenew = new AttendanceService();
        $attendanceServicenew->montlyFetcher($userid, $year, $month);
    }

    public function newUserFetcher($userid = 140, $year = 2021, $month = 9)
    {
        
    }

    public function dailyAttIn($date = '2021-9-1')
    {
        $attendanceServicenew = new AttendanceService();
        $attendanceServicenew->dailyAtt($date);
    }
}
