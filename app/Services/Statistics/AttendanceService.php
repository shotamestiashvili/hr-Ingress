<?php

namespace App\Services\Statistics;


use App\Services\Statistics\InoutService;
use App\Models\Inout;
use App\Models\Personnel;
use App\Services\Statistics\FetcherService;

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


    public function fetchAttDate($userid,  $year, $month)
    {
        $worker = new FetcherService($userid, $year, $month);
        return $worker->att_date;
    }


    public function montlyInout(): void
    {
        //00001 is an admin user at Ingress system for grid fetching
        if (!Inout::whereYear('date', $this->actualYear)
            ->whereMonth('date', $this->actualMonth)
            ->exists()) {
            $this->fetchAttDate('00001', $this->actualYear, $this->actualMonth)

                ->map(function ($date) {

                    Personnel::all()->map(function ($user) use ($date) {
                        Inout::create([
                            'userid' => $user['userid'],
                            'date'   => $date
                        ]);
                    });
                });
        }
    }

    public function newUserInout($user): void
    {
        //00001 is an admin user at Ingress system for grid fetching

        $this->fetchAttDate('00001', $this->actualYear, $this->actualMonth)
             ->map(function ($date) use ($user) {

                Inout::create([
                    'userid' => $user,
                    'date'   => $date,
                ]);
            });
    }



    public function dailyInout($date): void
    {

        Personnel::all()->map(function ($user) use ($date) {

            $this->fetchAttIn($user['userid'], $date)->map(function ($attIn) use ($user, $date) {

                (new Inout())->where('userid', $user['userid'])
                    ->where('date', $date)
                    ->update(['att_in'   => $attIn]);
            });

            $this->fetchAttBreak($user['userid'], $date)->map(function ($att_break) use ($user, $date) {
                (new Inout())->where('userid', $user['userid'])
                    ->where('date', $date)
                    ->update(['att_break'   => $att_break]);
            });

            $this->fetchAttResume($user['userid'], $date)->map(function ($att_resume) use ($user, $date) {
                (new Inout())->where('userid', $user['userid'])
                    ->where('date', $date)
                    ->update(['att_resume'   => $att_resume]);
            });

            $this->fetchAttOut($user['userid'], $date)->map(function ($att_out) use ($user, $date) {
                (new Inout())->where('userid', $user['userid'])
                    ->where('date', $date)
                    ->update(['att_out'   => $att_out]);
            });
        });
    }
}
