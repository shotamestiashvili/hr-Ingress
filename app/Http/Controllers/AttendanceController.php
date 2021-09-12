<?php

namespace App\Http\Controllers;

use App\Http\Resources\InoutResource;
use App\Models\Inout;
use App\Models\Schedule;
use App\Models\Training;
use App\Models\Worktype;
use App\Services\DateTime\DateTimeFormater;
use App\Services\DateTime\HourCalculator;
use App\Services\DateTime\WorkTypeFormater;
use App\Services\Statistics\AttendanceService;
use App\Services\Statistics\InoutService;
use App\Services\TimeCalculator\In;
use App\Services\TimeCalculator\Out;
use App\Services\TimeCalculator\StatisticGenerator;
use App\Services\TimeCalculator\Time;
use App\Services\TimeCalculator\TimeConstructor;
use App\Services\TimeCalculator\TimeService;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AttendanceController extends Controller
{
    public function test()
    {

        $today =  (Carbon::now())->toDateTimeString();
        $attendanceServicenew = new StatisticGenerator();
        return $attendanceServicenew->generate(DateTimeFormater::date($today));
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
}
