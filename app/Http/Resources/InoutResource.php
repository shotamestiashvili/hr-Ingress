<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InoutResource extends JsonResource
{


    protected function delay($request)
    {
        return "delay";
    }

    protected function unexcusable($request)
    {
        return "unexcusable";
    }

    protected function overtime($request)
    {
        return "overtime";
    }
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

            'start'       =>  $this->schedule->map(function ($schedule) {
                return $schedule->start;
            }),

            'end'       =>  $this->schedule->map(function ($schedule) {
                return $schedule->end;
            }),

            'honorminutes'       =>  $this->schedule->map(function ($schedule) {
                return $schedule->honorMinutes;
            }),

            'delay'              =>  $this->delay($this),

            'unexcusable'        =>  $this->unexcusable($this),

            'overtime'           => $this->overtime($this),

        ];
    }
}
