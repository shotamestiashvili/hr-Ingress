<?php

namespace App\Http\Resources;

use App\Services\Accounting\Overtime\OvertimeCalculation;
use Illuminate\Http\Resources\Json\JsonResource;

class OvertimeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $overtimeHourCalc = new OvertimeCalculation();
        return [
        'name' => $this->first_name .' '. $this->last_name,
        'position' => $this->position,
        'jan' =>  $overtimeHourCalc->overtimeHours($this->userid, 2021, 1),
        'feb' =>  $overtimeHourCalc->overtimeHours($this->userid, 2021, 2),
        'mar' =>  $overtimeHourCalc->overtimeHours($this->userid, 2021, 3),
        'apr' =>  $overtimeHourCalc->overtimeHours($this->userid, 2021, 4),
        'may' =>  $overtimeHourCalc->overtimeHours($this->userid, 2021, 5),
        'jun' =>  $overtimeHourCalc->overtimeHours($this->userid, 2021, 6),
        'jul' =>  $overtimeHourCalc->overtimeHours($this->userid, 2021, 7),
        'aug' =>  $overtimeHourCalc->overtimeHours($this->userid, 2021, 8),
        'sep' =>  $overtimeHourCalc->overtimeHours($this->userid, 2021, 9),
        'oct' =>  $overtimeHourCalc->overtimeHours($this->userid, 2021, 10),
        'nov' =>  $overtimeHourCalc->overtimeHours($this->userid, 2021, 11),
        'dec' =>  $overtimeHourCalc->overtimeHours($this->userid, 2021, 12),
    ];
    }
}
