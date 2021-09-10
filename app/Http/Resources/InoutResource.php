<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\TimeCalculator\Time;
use App\Services\TimeCalculator\Out;
use App\Services\TimeCalculator\In;
use App\Services\TimeCalculator\TimeService;

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
            'first_name'  => $this->personnel->map(function ($personnel) {
                return $personnel->first_name;
            }),
            'last_name'   => $this->personnel->map(function ($personnel) {
                return $personnel->last_name;
            }),
            'start'       =>  $this->schedule->map(function ($schedule) {
                return $schedule->start;
            }),
            'end'       =>  $this->schedule->map(function ($schedule) {
                return $schedule->end;
            }),
            'honorminutes'       =>  $this->schedule->map(function ($schedule) {
                return $schedule->honorMinutes;
            }),
            'earlyIn'            => $this->statistic->map(function ($statistic) {
                return $statistic->earlyIn;
            }),
            'delayIn'            => $this->statistic->map(function ($statistic) {
                return $statistic->delayIn;
            }),
            'earlyOut'           => $this->statistic->map(function ($statistic) {
                return $statistic->earlyOut;
            }),
            'lateOut'            => $this->statistic->map(function ($statistic) {
                return $statistic->lateOut;
            }),
        ];
    }
}
