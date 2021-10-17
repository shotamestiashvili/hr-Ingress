<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonnelResource extends JsonResource
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
            'userid' => $this->userid,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'personal_id' => $this->personal_id,
            'birth_day' => $this->birth_day,
            'gender' => $this->gender,
            'address' => $this->address,
            'retirement' => $this->retirement,
            'family_status' => $this->family_status,
            'education' => $this->education,
            'contact_info' => $this->contact_info,
            'position' => $this->position,
            'department' => $this->department,
            'head' => $this->head,
            'subordinate_stuff' => $this->subordinate_stuff,
            'military_info' => $this->military_info,
            'phone' => $this->phone,
            'email' => $this->email,
            'author' => $this->author,
            'food' => $this->food,
            'ensuarence' => $this->ensuarence,
            'additional' => $this->additional,
            'bank_account' => $this->bank_account,
            'companyid' => $this->companyid,
            'avatar_url' => $this->avatar_url,
            'selectedWorktype' => $this->schedule->map(function($schedule){
                return [$schedule->selectedDay => $schedule->selectedWorktype ];
            }),
        ];

    }
}
