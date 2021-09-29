<?php

namespace App\Http\Controllers;


use App\Jobs\ScheduleDateColumnFormater;
use App\Models\Worktype;
use App\Services\DateTime\DateTimeFormater;
use App\Services\DateTime\WorkTypeFormater;
use App\Services\Statistics\AttendanceService;
use App\Services\TimeCalculator\StatisticGenerator;
use App\Services\TimeCalculator\TimeService;
use Carbon\Carbon;


class AttendanceController extends Controller
{
    public function timeService()
    {
        return (new TimeService(133, date('2021-09-01')))->lateOut;
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
