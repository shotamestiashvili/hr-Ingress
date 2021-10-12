<?php

namespace App\Http\Resources;

use App\Services\Accounting\MSO\MsoCalculation;
use Illuminate\Http\Resources\Json\JsonResource;

class MsoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $msoHourCalc = new MsoCalculation();
        return [
            'name' => $this->first_name .' '. $this->last_name,
            'position' => $this->position,
            'jan' =>  $msoHourCalc->msoHours($this->userid, 2021, 1),
            'feb' =>  $msoHourCalc->msoHours($this->userid, 2021, 2),
            'mar' =>  $msoHourCalc->msoHours($this->userid, 2021, 3),
            'apr' =>  $msoHourCalc->msoHours($this->userid, 2021, 4),
            'may' =>  $msoHourCalc->msoHours($this->userid, 2021, 5),
            'jun' =>  $msoHourCalc->msoHours($this->userid, 2021, 6),
            'jul' =>  $msoHourCalc->msoHours($this->userid, 2021, 7),
            'aug' =>  $msoHourCalc->msoHours($this->userid, 2021, 8),
            'sep' =>  $msoHourCalc->msoHours($this->userid, 2021, 9),
            'oct' =>  $msoHourCalc->msoHours($this->userid, 2021, 10),
            'nov' =>  $msoHourCalc->msoHours($this->userid, 2021, 11),
            'dec' =>  $msoHourCalc->msoHours($this->userid, 2021, 12),
        ];
    }
}
