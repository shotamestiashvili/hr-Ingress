<?php

namespace App\Http\Resources;

use App\Services\PaidLeave\PaidLeaveService;
use Illuminate\Http\Resources\Json\JsonResource;

class PaidLeaveResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => $this->first_name .' '. $this->last_name,
            'position' => $this->position,
            'total_allowed' => PaidLeaveService::PaidLeaveDays,
            'jan' =>  PaidLeaveService::calcMonthlyWaste($this->userid, 2021, 1),
            'feb' =>  PaidLeaveService::calcMonthlyWaste($this->userid, 2021, 2),
            'mar' =>  PaidLeaveService::calcMonthlyWaste($this->userid, 2021, 3),
            'apr' =>  PaidLeaveService::calcMonthlyWaste($this->userid, 2021, 4),
            'may' =>  PaidLeaveService::calcMonthlyWaste($this->userid, 2021, 5),
            'jun' =>  PaidLeaveService::calcMonthlyWaste($this->userid, 2021, 6),
            'jul' =>  PaidLeaveService::calcMonthlyWaste($this->userid, 2021, 7),
            'aug' =>  PaidLeaveService::calcMonthlyWaste($this->userid, 2021, 8),
            'sep' =>  PaidLeaveService::calcMonthlyWaste($this->userid, 2021, 9),
            'oct' =>  PaidLeaveService::calcMonthlyWaste($this->userid, 2021, 10),
            'nov' =>  PaidLeaveService::calcMonthlyWaste($this->userid, 2021, 11),
            'dec' =>  PaidLeaveService::calcMonthlyWaste($this->userid, 2021, 12),
            'total_used' => PaidLeaveService::calcYearlyWaste($this->userid, 2021),
            'total_remain' => PaidLeaveService::calcRemainDays($this->userid, 2021),
        ];
    }
}
