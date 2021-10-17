<?php

namespace App\Http\Resources;

use App\Services\PaidLeave\PaidLeaveService;
use App\Services\SickLeave\SickLeaveService;
use Illuminate\Http\Resources\Json\JsonResource;

class SickLeaveResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return    [
        'name' => $this->first_name .' '. $this->last_name,
        'position' => $this->position,
        'total_allowed' => SickLeaveService::SickLeaveDays,
        'jan' =>  SickLeaveService::calcMonthlyWaste($this->userid, 2021, 1),
        'feb' =>  SickLeaveService::calcMonthlyWaste($this->userid, 2021, 2),
        'mar' =>  SickLeaveService::calcMonthlyWaste($this->userid, 2021, 3),
        'apr' =>  SickLeaveService::calcMonthlyWaste($this->userid, 2021, 4),
        'may' =>  SickLeaveService::calcMonthlyWaste($this->userid, 2021, 5),
        'jun' =>  SickLeaveService::calcMonthlyWaste($this->userid, 2021, 6),
        'jul' =>  SickLeaveService::calcMonthlyWaste($this->userid, 2021, 7),
        'aug' =>  SickLeaveService::calcMonthlyWaste($this->userid, 2021, 8),
        'sep' =>  SickLeaveService::calcMonthlyWaste($this->userid, 2021, 9),
        'oct' =>  SickLeaveService::calcMonthlyWaste($this->userid, 2021, 10),
        'nov' =>  SickLeaveService::calcMonthlyWaste($this->userid, 2021, 11),
        'dec' =>  SickLeaveService::calcMonthlyWaste($this->userid, 2021, 12),
        'total_used' => SickLeaveService::calcYearlyWaste($this->userid, 2021),
        'total_remain' => SickLeaveService::calcRemainDays($this->userid, 2021),
    ];
    }
}
