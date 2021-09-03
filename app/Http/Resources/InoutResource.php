<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InoutResource extends JsonResource
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
            'userid'      => $this->userid,
            'date'        => $this->date,
            'att_in'      => $this->att_in,
            'att_break'   => $this->att_break,
            'att_resume'  => $this->att_resume,
            'att_out'     => $this->att_out,
            'start'       => '$this->',
            'end'         => '$this->',
            'honorminutes'       => '$this->',
            'delay'              => '$this->',
            'unexcusable'        => '$this->',
            'overtime'           => '$this->',

        ];
    }
}
