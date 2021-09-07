<?php

namespace App\Services\Schedule;


use App\Http\Interfaces\UpdaterInterface;
use App\Models\Schedule;
use App\Models\Worktype;
use App\Services\DateTime\DateTimeFormater;

class UpdateSchedule implements UpdaterInterface
{

    public function update($object)
    {
        Schedule::where('id', $object->id)
                 ->update([
                    'userid'=> $object->userid,
                    'date'  => DateTimeFormater::date($object->selectedYear.'-'.$object->selectedMonth.'-'.$object->selectedDay),
                    'start' => Worktype::where('code', $object->selectedWorktype)->value('start'),
                    'end'   => Worktype::where('code', $object->selectedWorktype)->value('end'),
                    'honorMinutes' => $object->honorMinutes,
                    'selectedAbsence' => $object->selectedAbsence,
                    'selectedDay' => $object->selectedDay,
                    'selectedMonth' => $object->selectedMonth,
                    'selectedYear' => $object->selectedYear,
                    'selectedPosition' => $object->selectedPosition,
                    'selectedWorktype' => $object->selectedWorktype,
            ]);
    }
}
