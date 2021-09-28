<?php

namespace App\Http\Controllers;


use App\Jobs\ScheduleDateColumnFormater;
use App\Models\Worktype;
use App\Services\DateTime\DateTimeFormater;
use App\Services\DateTime\WorkTypeFormater;
use App\Services\Statistics\AttendanceService;
use App\Services\TimeCalculator\StatisticGenerator;
use Carbon\Carbon;


class AttendanceController extends Controller
{
    public function test()
    {

        ScheduleDateColumnFormater::dispatch();
//        $personnel = Personnel::with('inout')->get();
//
//        $monthDays = Personnel::with('inout')->where('userid', 352)
//        ->get()
//        ->map(function($user){
//            return $user->inout->map(function($inout){
//                return $inout->date;
//            })->count();
//        });
    }

    public function worktypeTime()
    {
        $worktype = new Worktype();
        return $worktype->all()->map(function ($worktype) {
            $object = (new WorkTypeFormater($worktype['start'], $worktype['end']));
            $worktype->where('end', $worktype['end'])
                ->where('start', $worktype['start'])
                ->update([
                    'in24hours' => $object->in24Hours($object->worktypeHoursGen())
                ]);
        });
    }

    public function monthlyGrid()
    {
        $attendanceServicenew = new AttendanceService();
        $attendanceServicenew->montlyInout();
    }

    public function refresh()
    {
        $today =  (Carbon::now())->toDateTimeString();
        $attendanceServicenew = new AttendanceService();
        $attendanceServicenew->dailyInout(DateTimeFormater::date( $today ));
    }


    public function statisticGenerate()
    {
        $today =  (Carbon::now())->toDateTimeString();
        $attendanceServicenew = new StatisticGenerator();
        $attendanceServicenew->generate(DateTimeFormater::date($today));
    }

    public function newUserGrid()
    {
        $userid = 99999;
        $attendanceServicenew = new AttendanceService();
        $attendanceServicenew->newUserInout($userid);
    }




}
