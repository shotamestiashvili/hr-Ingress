<?php

namespace App\Services\Statistics;

use App\Models\Attendance;
use App\Services\DateTime\DateTimeFormater;
use App\Models\Inout;
use App\Models\Personnel;
use Carbon\Carbon;

//Main Service for Attenance//

class AttendanceService extends ActualDate
{

    public function fetchAttIn($userid, $date)
    {
        $worker = new InoutService($userid, $date);
        return $worker->att_in;
    }

    public function fetchAttBreak($userid, $date)
    {
        $worker = new InoutService($userid, $date);
        return $worker->att_break;
    }

    public function fetchAttResume($userid, $date)
    {
        $worker = new InoutService($userid, $date);
        return $worker->att_resume;
    }

    public function fetchAttOut($userid, $date)
    {
        $worker = new InoutService($userid, $date);
        return $worker->att_out;
    }


    public function monthlyGrid(): void
    {
        //352 is an admin user at Ingress system for grid fetching

        $month = $this->actualMonth;
        $year  = $this->actualYear;

        if (!Inout::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->exists()) {

            Attendance::where('userid', 352)
                ->whereYear('date',  $year)
                ->whereMonth('date', $month)
                ->get('date')
                ->map(function ($date) {

                    Personnel::get('userid')->map(function ($user) use ($date) {
                        Inout::create([
                            'userid' => $user->userid,
                            'date'   => $date->date
                        ]);
                    });
                });
        }
    }

    public function newUserInout($userId): void
    {
        //352 is an admin user at Ingress system for grid fetching

        Attendance::where('userid', 352)
            ->whereYear('date', $this->actualYear)
            ->whereMonth('date', $this->actualMonth)
            ->get('date')
            ->map(function ($date) use ($userId) {

                Inout::create([
                    'userid' => $userId,
                    'date' => $date->date,
                ]);
            });
    }


    public function dailyInout()
    {
        $today = (Carbon::now())->toDateTimeString();
        $date = DateTimeFormater::date($today);

        return Personnel::get('userid')->map(function ($user) use ($date) {

            return Attendance::where('userid', $user->userid)
                ->where('date', $date)
                ->get(['att_in', 'att_out', 'att_break', 'att_resume'])
                ->map(function ($attendance) use ($user, $date)

                {
                    Inout::where('userid', $user->userid)
                        ->where('date', $date)
                        ->update([
                            'att_in' => $attendance->att_in,
                            'att_break' => $attendance->att_break,
                            'att_resume' => $attendance->att_resume,
                            'att_out' => $attendance->att_out,
                        ]);
                });
        });
    }

    public function monthlyInout()
    {
        $month = $this->actualMonth;
        $year  = $this->actualYear;

        Personnel::get('userid')->map(function ($user) use ($month, $year) {

                    return Attendance::where('userid', $user->userid)
                        ->whereMonth('date', $month)
                        ->whereYear('date',  $year)
                        ->get(['att_in', 'att_out', 'att_break', 'att_resume', 'date'])
                        ->map(function ($attendance) use ($user)

                        {
                            Inout::where('userid', $user->userid)
                                 ->where('date', $attendance->date)
                                 ->update([
                                    'att_in' => $attendance->att_in,
                                    'att_break' => $attendance->att_break,
                                    'att_resume' => $attendance->att_resume,
                                    'att_out' => $attendance->att_out,
                                ]);
                        });
                });
    }
}
