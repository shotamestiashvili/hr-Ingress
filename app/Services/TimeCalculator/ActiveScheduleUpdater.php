<?php

namespace App\Services\TimeCalculator;

class ActiveScheduleUpdater
{
    public function activeDecisionMaker($userid, $active_schedule, $in24, $previousIn24)
    {

        if ($in24 == 1 && $previousIn24 == 1) {

            $intime    = $this->attFirstCatcher($userid, $active_schedule->startdate);
            $outtime   = $this->attSecondCatcher($userid, $active_schedule->enddate);

            \App\Jobs\ActiveScheduleUpdater::dispatch($userid, $active_schedule->startdate, $in24, $previousIn24, $intime, $outtime)->delay(15);

        } elseif ($in24 == 0 && $previousIn24 == 1) {
            $intime = $this->attFirstCatcher($userid, $active_schedule->startdate);
            $outtime = $this->attFirstCatcher($userid, $active_schedule->enddate);

            \App\Jobs\ActiveScheduleUpdater::dispatch($userid, $active_schedule->startdate, $in24, $previousIn24, $intime, $outtime)->delay(15);

        } elseif ($in24 == 0 && $previousIn24 == 0) {

            $intime  = $this->attSecondCatcher($userid, $active_schedule->startdate);
            $outtime = $this->attFirstCatcher($userid, $active_schedule->enddate);

            \App\Jobs\ActiveScheduleUpdater::dispatch($userid, $active_schedule->startdate, $in24, $previousIn24, $intime, $outtime)->delay(15);

        } elseif ($in24 == 1 && $previousIn24 == 0) {

            $intime = ($this->attSecondCatcher($userid, $active_schedule->startdate));
            $outtime = $this->attThirdCatcher($userid, $active_schedule->enddate);

            \App\Jobs\ActiveScheduleUpdater::dispatch($userid, $active_schedule->startdate, $in24, $previousIn24, $intime, $outtime)->delay(15);

        }
    }

    public function attFirstCatcher($userid, $date)
    {
        $humanattendance = (new HumanAttendance($userid, $date));
        return $humanattendance->first;
    }

    public function attSecondCatcher($userid, $date)
    {

        $humanattendance = new HumanAttendance($userid, date($date));
        return $humanattendance->second;

    }

    public function attThirdCatcher($userid, $date)
    {
        $humanattendance = (new HumanAttendance($userid, $date));
        return $humanattendance->third;
    }

    public function attFourthCatcher($userid, $date)
    {
        $humanattendance = (new HumanAttendance($userid, $date));
        return $humanattendance->fourth;
    }


}
