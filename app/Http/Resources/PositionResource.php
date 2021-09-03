<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PositionResource extends JsonResource
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
            'position_name' => $this->position_name,
            'description'=> $this->description,
            'code' => $this->code,
            'salary' => $this->salary,
            'job_description' => $this->job_description,
            'experiance' => $this->experiance,
            'note' => $this->note,
            'cost_center' => $this->cost_center,
            'confirmation' => $this->confirmation,
            'no_confirmation' => $this->no_confirmation,
            'epl_count' => $this->epl_count
        ];
    }
}
