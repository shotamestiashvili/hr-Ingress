<?php

namespace App\Http\Controllers;

use App\Http\Resources\InoutResource;
use App\Models\Inout;
use App\Models\Schedule;
use App\Models\Worktype;
use App\Services\DateTime\DateTimeFormater;
use App\Services\DateTime\HourCalculator;
use App\Services\DateTime\WorkTypeFormater;
use App\Services\Statistics\AttendanceService;
use App\Services\TimeCalculator\TimeConstructor;

class AttendanceController extends Controller
{
    public function carbon()
    {
        return (new WorkTypeFormater('09:30', "10:30"))->worktypeHoursGen(3);
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
