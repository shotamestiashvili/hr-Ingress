<?php

namespace App\Services\TimeCalculator;


use App\Services\DateTime\DateTimeFormater;


class TimeService
{
    public $earlyIn;
    public $delayIn;
    public $lateOut;
    public $earlyOut;


    public function __construct($active_schedule, $in24)
    {
        if (

            $active_schedule->intime  !== null &&
            $active_schedule->outtime  !== null)
        {

            $att       = new AttExploder($active_schedule->intime, $active_schedule->outtime);
            $worktype  = new TimeExploder($active_schedule->starttime, $active_schedule->endtime);

            dd($worktype);
            $this->conditionValidationIn($active_schedule, $att, $worktype, $in24);
            $this->conditionValidationOut( $active_schedule, $att, $worktype, $in24);

        } else {

            $this->earlyIn  = 0;
            $this->delayIn  = 0;
            $this->lateOut  = 0;
            $this->earlyOut = 0;
        }
    }


    public function conditionValidationIn($active_schedule, $att, $worktype)
    {
        if ($att->att_inHour > $worktype->startHour) {
            $this->DelayIn($active_schedule->intime,$active_schedule->starttime);
        } elseif ($att->att_inHour < $worktype->startHour) {
            $this->EarlyIn($active_schedule->intime, $active_schedule->starttime);
        } elseif ($att->att_inHour == $worktype->startHour && $att->att_inMin > $worktype->startMin) {
            $this->DelayIn($active_schedule->intime, $active_schedule->starttime);
        } elseif ($att->att_inHour == $worktype->startHour && $att->att_inMin < $worktype->startMin) {
            $this->EarlyIn($active_schedule->intime, $active_schedule->starttime);
        }elseif ($att->att_inHour == $worktype->startHour && $att->att_inMin == $worktype->startMin) {
            $this->EarlyIn($active_schedule->intime, $active_schedule->starttime);
        }
    }

    public function conditionValidationOut($active_schedule, $att, $worktype, $in24)
    {

        if ($att->att_outHour > $worktype->endHour && $in24 == 1) {
            $this->LateOut($active_schedule->outtime, $active_schedule->endtime);
        }elseif ($att->att_outHour > $worktype->endHour && $in24 == 0) {
            $this->EarlyOut($active_schedule->outtime, $active_schedule->endtime);
        }elseif ($att->att_outHour < $worktype->endHour  && $in24 == 1) {
            $this->EarlyOut($active_schedule->outtime, $active_schedule->endtime);
        }elseif ($att->att_outHour < $worktype->endHour  && $in24 == 0) {
            $this->LateOut($active_schedule->outtime, $active_schedule->endtime);
        }elseif ($att->att_outHour == $worktype->endHour
            && $att->att_outMin > $worktype->endMin
            && $in24 == 1) {
            $this->LateOut($active_schedule->outtime, $active_schedule->endtime);
        }elseif ($att->att_outHour == $worktype->endHour
            && $att->att_outMin > $worktype->endMin
            && $in24 == 0) {
            $this->EarlyOut($active_schedule->outtime, $active_schedule->endtime);
        }elseif ($att->att_outHour == $worktype->endHour
            && $att->att_outMin  < $worktype->endMin
            && $in24 == 1) {
            $this->EarlyOut($active_schedule->outtime, $active_schedule->endtime);
        }elseif ($att->att_outHour == $worktype->endHour
            && $att->att_outMin  < $worktype->endMin
            && $in24 == 0) {
            $this->LateOut($active_schedule->outtime,  $active_schedule->endtime);
        }elseif($att->att_outHour == $worktype->endHour && $att->att_outMin  == $worktype->endMin){
            $this->LateOut($active_schedule->outtime, $active_schedule->endtime);
        }
    }


    public function DelayIn($inHour, $startHour)
    {
        $this->delayIn =
            DateTimeFormater::timeFormat($inHour)
            ->diff(DateTimeFormater::timeFormat($startHour))
            ->format('%H:%i');

        $this->earlyIn = 0;
    }


    public function EarlyIn($inHour, $startHour)
    {
        $this->earlyIn =
            DateTimeFormater::timeFormat($startHour)
            ->diff(DateTimeFormater::timeFormat($inHour))
            ->format('%H:%i');

        $this->delayIn = 0;
    }

    public function LateOut($outHour, $endHour)
    {
        $this->lateOut =
            DateTimeFormater::timeFormat($endHour)
            ->diff(DateTimeFormater::timeFormat($outHour))
            ->format('%H:%i');

        $this->earlyOut = 0;
    }


    public function EarlyOut($outHour, $endHour)
    {
        $this->earlyOut =
            DateTimeFormater::timeFormat($outHour)
            ->diff(DateTimeFormater::timeFormat($endHour))
            ->format('%H:%i');

        $this->lateOut = 0;
    }
}
