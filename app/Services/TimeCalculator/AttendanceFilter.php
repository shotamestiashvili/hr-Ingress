<?php

namespace App\Services\TimeCalculator;

use App\Models\ActiveSchedule;
use App\Models\Personnel;
use App\Models\Worktype;
use Carbon\Carbon;

class AttendanceFilter
{
    public function humanAttendanceRunner()
    {
       $today = (Carbon::now())->toDateTimeString();
//        $today = date('2021-10-02');
      Personnel::get('userid')->map(function ($user) use ($today) {
           ActiveSchedule::with('worktypes')
                ->where('startdate', $today)
                ->where('userid', $user->userid)
                ->get()
                ->map(function ($active_schedule) use ($user) {
                   $active_schedule->worktypes->map(function ($worktype) use ($user, $active_schedule)
                        {
                            $in24 = $worktype->in24hours;
                            if ($worktype->in24hours === null) {$in24 = 1;}

                            $yesterday = Carbon::createFromDate($active_schedule->startdate)->subDay()->toDateString();
                            $previousIn24 = $this->yesterdayIn24($yesterday, $user->userid);

                            if ($previousIn24 === null) {$previousIn24 = 1;}

                          (new ActiveScheduleUpdater())->activeDecisionMaker($user->userid, $active_schedule, $in24, $previousIn24);
                        });
                });
        });
    }

    public function humanAttendanceRunnerMonthly()
    {
        $from = '2021-10-1';
        $to   = '2021-10-31';
//        $today = date('2021-10-02');
        Personnel::get('userid')->map(function ($user) use ($from, $to) {
            ActiveSchedule::with('worktypes')
                ->whereBetween('startdate', [$from, $to])
                ->where('userid', $user->userid)
                ->get()
                ->map(function ($active_schedule) use ($user) {
                    $active_schedule->worktypes->map(function ($worktype) use ($user, $active_schedule)
                    {
                        $in24 = $worktype->in24hours;
                        if ($worktype->in24hours === null) {$in24 = 1;}

                        $yesterday = Carbon::createFromDate($active_schedule->startdate)->subDay()->toDateString();
                        $previousIn24 = $this->yesterdayIn24($yesterday, $user->userid);

                        if ($previousIn24 === null) {$previousIn24 = 1;}

                        (new ActiveScheduleUpdater())->activeDecisionMaker($user->userid, $active_schedule, $in24, $previousIn24);
                    });
                });
        });
    }

    public function yesterdayIn24($user, $date)
    {
        $worktype = ActiveSchedule::
        where('userid', $user)
            ->where('startdate', $date)
            ->value('worktype');

        return Worktype::where('code', $worktype)->value('in24hours');
    }




}
