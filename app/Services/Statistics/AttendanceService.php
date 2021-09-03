<?php

namespace App\Services\Statistics;


use App\Services\Statistics\InoutService;
use App\Models\Inout;
use App\Models\Personnel;
use App\Services\Statistics\FetcherService;


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


    public function fetchAttDate($userid,  $year, $month)
    {
        $worker = new FetcherService($userid, $year, $month);
        return $worker->att_date;
    }


    public function montlyFetcher($userid, $year, $month): void
    {

        if (!Inout::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->exists()) {

            $this->fetchAttDate($userid, $year, $month)->map(function ($date) {

                Personnel::all()->map(function ($user) use ($date) {
                    Inout::create([
                        'userid' => $user['userid'],
                        'date'   => $date,
                    ]);
                });
            });
        }
    }

    public function newUserFetcher(): void
    {
        $year  = $this->actualYear;
        $month = $this->actualMonth;


        Personnel::all()->map(function ($user) use ($year, $month) {

            if (!Inout::where('userid', $user['userid'])->exists())
            {
                $this->fetchAttDate('00001', $year, $month)->map(function ($date) use ($user) {

                    Inout::create([
                        'userid' => $user['userid'],
                        'date'   => $date,
                    ]);
                });
            }
        });
    }



    public function dailyAtt($date): void
    {

        Personnel::all()->map(function ($user) use ($date) {

            if (Inout::where('userid', $user['userid'])
                ->where('date', $date)
                ->first('att_in') == Null
            ) {

                $this->fetchAttIn($user['userid'], $date)->map(function ($attIn) use ($user) {
                    (new Inout())->where('userid', $user['userid'])
                        ->update(['att_in'   => $attIn]);
                });
            }

            if (Inout::where('userid', $user['userid'])
                ->where('date', $date)
                ->first('att_break') == Null
            ) {

                $this->fetchAttBreak($user['userid'], $date)->map(function ($att_break) use ($user) {
                    (new Inout())->where('userid', $user['userid'])
                        ->update(['att_break'   => $att_break]);
                });
            }


            if (Inout::where('userid', $user['userid'])
                ->where('date', $date)
                ->first('att_resume') == Null
            ) {

                $this->fetchAttResume($user['userid'], $date)->map(function ($att_resume) use ($user) {
                    (new Inout())->where('userid', $user['userid'])
                        ->update(['att_resume'   => $att_resume]);
                });
            }

            if (
                Inout::where('userid', $user['userid'])
                ->where('date', $date)
                ->first('att_out') == Null
            ) {

                $this->fetchAttOut($user['userid'], $date)->map(function ($att_out) use ($user) {
                    (new Inout())->where('userid', $user['userid'])
                        ->update(['att_out'   => $att_out]);
                });
            }
        });
    }
}
