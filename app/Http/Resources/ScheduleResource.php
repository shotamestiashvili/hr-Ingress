<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'userid'=> $this->userid,
            'honorMinutes' => $this->honorMinutes,
            'selectedAbsence' => $this->selectedAbsence,
            'selectedDay' => $this->selectedDay,
            'selectedMonth' => $this->selectedMonth,
            'selectedYear' => $this->selectedYear,
            'selectedPosition' => $this->selectedPosition,
            'selectedWorktype' => $this->selectedWorktype,
        ];
    }
}
