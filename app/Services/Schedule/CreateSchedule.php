<?php

namespace App\Services\Schedule;


use App\Http\Interfaces\CreatorInterface;
use App\Models\PaidLeave;
use App\Models\Personnel;
use App\Models\Schedule;
use App\Models\SickLeave;
use App\Models\Worktype;
use App\Services\DateTime\DateTimeFormater;

class CreateSchedule implements CreatorInterface
{

    public function create($object)
    {
        $date     = DateTimeFormater::date($object->selectedYear.'-'.$object->selectedMonth.'-'.$object->selectedDay);
        $position = Personnel::where('userid', $object->userid)->value('position');

        Schedule::create([
            'userid'=> $object->userid,
            'date' =>  $date,
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

        if ($object->selectedWorktype === 'VL')
        {
            PaidLeave::create([
                'userid' => $object->userid,
                'position' =>$position,
                'yearly_balance' => 24,
                'leave_type' => 'VL',
                'leave_date' => $date,
            ]);
        }elseif($object->selectedWorktype === 'SL')
        {
            SickLeave::create([
                'userid' => $object->userid,
                'position' => $position,
                'yearly_balance' => 24,
                'leave_type' => 'SL',
                'leave_date' => $date,
            ]);
        }
    }
}
