<?php

namespace App\Http\Controllers;

use App\Services\DateTime\DateTimeFormater;
use App\Services\Statistics\AttendanceService;

class AttendanceController extends Controller
{
    public function montlyFetcher()
    {
        $attendanceServicenew = new AttendanceService();
        $attendanceServicenew->montlyFetcher();
    }

    public function newUserFetcher($userid = 140, $year = 2021, $month = 9)
    {

    }

    public function dailyAtt()
    {
        $attendanceServicenew = new AttendanceService();
        $attendanceServicenew->dailyAtt(DateTimeFormater::date('2021-9-1'));
    }

    public function fetchAttIn()
    {
        $attendanceServicenew = new AttendanceService();
        return $attendanceServicenew->fetchAttIn('140', DateTimeFormater::date('2021-9-1'));
    }


    public function carbon($date = '2021-9-1')
    {
        return DateTimeFormater::date($date);
    }

}
