<?php

namespace App\Http\Controllers;


use App\Jobs\ScheduleDateColumnFormater;
use App\Models\ActiveSchedule;
use App\Models\Personnel;
use App\Models\Worktype;
use App\Services\DateTime\DateTimeFormater;
use App\Services\DateTime\WorkTypeFormater;
use App\Services\Statistics\AttendanceService;
use App\Services\TimeCalculator\ActiveScheduleUpdater;
use App\Services\TimeCalculator\AttendanceFilter;
use App\Services\TimeCalculator\StatisticGenerator;
use App\Services\TimeCalculator\TimeConstructor;
use Carbon\Carbon;


class AttendanceController extends Controller
{

    public function human()
    {
        $human = new AttendanceFilter();
        $human->humanAttendanceRunner();
    }

    public function test()
    {
        $startTime  = '05:00';
        $finishTime = '01:00';

       return Carbon::parse($startTime)->diff($finishTime)->format('%H:%I');
//        return $finishTime->diff($startTime)->format('%H:%I');
//        return Carbon::createFromDate('07:00')->addHour('05:00')->toTimeString();
    }


    public function timeService()
    {
        $time = new TimeConstructor(352, date('2021-09-09'));
//        return (new TimeService(133, date('2021-09-01')))->lateOut;

        return $time->in24;
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

    public function dailyInout()
    {
        $att = new AttendanceService();
        $att->dailyInout();
    }

    public function monthlyInout()
    {
        $att = new AttendanceService();
        $att->monthlyInout();
    }

    public function monthlyGrid()
    {
        $att = new AttendanceService();
        $att->monthlyGrid();
    }

    public function dailyGenerate()
    {
        $statistic = new  StatisticGenerator();
        $statistic->generateDaily();
    }

    public function monthlyGenerate()
    {
        $statistic = new  StatisticGenerator();
        $statistic->generateMonthly();
    }


}
