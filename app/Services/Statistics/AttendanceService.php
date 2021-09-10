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
        //352 is an admin user at Ingress system for grid fetching
        if (!Inout::whereYear('date', $this->actualYear)
            ->whereMonth('date', $this->actualMonth)
            ->exists()) {
            $this->fetchAttDate(352, $this->actualYear, $this->actualMonth)

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
        //352 is an admin user at Ingress system for grid fetching

        $this->fetchAttDate(352, $this->actualYear, $this->actualMonth)
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
                Inout::where('userid', $user['userid'])
                    ->where('date', $date)
                    ->update([
                           'att_in' => $this->fetchAttIn($user['userid'], $date),
                           'att_break' => $this->fetchAttBreak($user['userid'], $date),
                           'att_resume' => $this->fetchAttResume($user['userid'], $date),
                           'att_out' => $this->fetchAttOut($user['userid'], $date),
                ]);
            });
    }

}
