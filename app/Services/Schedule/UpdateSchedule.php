<?php

namespace App\Services\Schedule;


use App\Http\Interfaces\UpdaterInterface;
use App\Models\Schedule;

class UpdateSchedule implements UpdaterInterface
{

    public function update($object)
    {
        Schedule::where('id', $object->id)
                 ->update([
                    'userid'=> $object->userid,
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
