<?php

namespace App\Services\TimeCalculator;

use App\Models\Inout;
use App\Models\Schedule;
use App\Services\DateTime\DateTimeFormater;


class TimeService
{
    public $earlyIn;
    public $delayIn;
    public $lateOut;
    public $earlyOut;


    public function __construct($userid, $date)
    {

        if (
            Schedule::where('userid', $userid)->where('date', $date)->exists() &&
            Inout::where('userid', $userid)->where('date', $date)->value('att_in')  !== Null &&
            Inout::where('userid', $userid)->where('date', $date)->value('att_out') !== Null

        ) {

            $time      = new TimeConstructor($userid, $date);
            $att       = new AttExploder($time->att_in, $time->att_out);
            $worktype  = new TimeExploder($time->start, $time->end);

            $this->conditionValidation($time, $att, $worktype);
        } else {

            $this->earlyIn  = 0;
            $this->delayIn  = 0;
            $this->lateOut  = 0;
            $this->earlyOut = 0;
        }
    }


    public function conditionValidation($time, $att, $worktype)
    {

        if ($att->att_inHour > $worktype->startHour) {
            $this->DelayIn($time->att_in, $time->start);
        } elseif ($att->att_inHour < $worktype->startHour) {
            $this->EarlyIn($time->att_in, $time->start);
        } elseif ($att->att_inHour == $worktype->startHour && $att->att_inMin > $worktype->startMin) {
            $this->DelayIn($time->att_in, $time->start);
        } elseif ($att->att_inHour == $worktype->startHour && $att->att_inMin < $worktype->startMin) {
            $this->EarlyIn($time->att_in, $time->start);
        }

        if ($att->att_outHour > $worktype->endHour) {
            $this->LateOut($time->att_out, $time->end);
        } elseif ($att->att_outHour < $worktype->endHour) {
            $this->EarlyOut($time->att_out, $time->end);
        } elseif ($att->att_outHour == $worktype->endHour && $att->att_outMin > $worktype->endMin) {
            $this->LateOut($time->att_out, $time->end);
        } elseif ($att->att_outHour == $worktype->endHour && $att->att_outMin  < $worktype->endMin) {

            $this->EarlyOut($time->att_out, $time->end);
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
            DateTimeFormater::timeFormat($endHour)
            ->diff(DateTimeFormater::timeFormat($outHour))
            ->format('%H:%i');

        $this->lateOut = 0;
    }
}
