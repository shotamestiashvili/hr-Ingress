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


        if (isset($active_schedule->intime)  &&  isset($active_schedule->outtime)  )
        {
            $att       = new AttExploder($active_schedule->intime, $active_schedule->outtime);
            $worktype  = new TimeExploder($active_schedule->starttime, $active_schedule->endtime);

            $this->conditionValidationIn($active_schedule, $att, $worktype, $in24);

            $this->conditionValidationOut( $active_schedule, $att, $worktype, $in24);
//            dd($this->lateOut, $this->earlyOut);

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
//     dd($att, $worktype, $in24);
//
//        if($att->att_outHour > $worktype->endHour && ($in24 == 1) ){
//            dd('1 cond');
//        }else {
//            dd('second');
//    }

        if (($att->att_outHour > $worktype->endHour) && ($in24 == 1)) {
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
        }elseif($att->att_outHour == 0 && $att->att_outMin  == 0)
        {
            $this->earlyOut = 0;
            $this->lateOut = 0;
        }
    }


    public function DelayIn($inHour, $startHour)
    {
        if($inHour == 0){
            $this->delayIn = 0;
        }else {
        $this->delayIn =
            DateTimeFormater::timeFormat($inHour)
            ->diff(DateTimeFormater::timeFormat($startHour))
            ->format('%H:%i');
}

        $this->earlyIn = 0;
    }


    public function EarlyIn($inHour, $startHour)
    {
        if($inHour == 0){
            $this->earlyIn = 0;
        }else {
            $this->earlyIn =
                DateTimeFormater::timeFormat($startHour)
                    ->diff(DateTimeFormater::timeFormat($inHour))
                    ->format('%H:%i');
        }

        $this->delayIn = 0;
    }

    public function LateOut($outHour, $endHour)
    {
        if($outHour == 0){
            $this->lateOut = 0;
        }else {
            $this->lateOut =
                DateTimeFormater::timeFormat($endHour)
                    ->diff(DateTimeFormater::timeFormat($outHour))
                    ->format('%H:%i');
        }
        $this->earlyOut = 0;
    }


    public function EarlyOut($outHour, $endHour)
    {

       if($outHour == 0){
           $this->earlyOut = 0;
       }else {
           $this->earlyOut =
               DateTimeFormater::timeFormat($outHour)
                   ->diff(DateTimeFormater::timeFormat($endHour))
                   ->format('%H:%i');
       }

        $this->lateOut = 0;
    }
}
