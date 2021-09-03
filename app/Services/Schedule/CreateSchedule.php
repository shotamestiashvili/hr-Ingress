<?php

namespace App\Services\Schedule;


use App\Http\Interfaces\CreatorInterface;
use App\Models\Schedule;

class CreateSchedule implements CreatorInterface
{

    public function create($object)
    {
        Schedule::create([
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
