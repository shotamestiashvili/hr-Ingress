<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StatisticResource extends JsonResource
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
            'userid' => $this->userid,
            'date' => $this->date,
            'earlyIn' => $this->earlyIn,
            'delayIn' => $this->delayIn,
            'lateOut' => $this->lateOut,
            'earlyOut' => $this->earlyOut,
        ];
    }
}
