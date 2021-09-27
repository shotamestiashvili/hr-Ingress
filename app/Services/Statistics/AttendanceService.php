<?php

namespace App\Services\Statistics;

use App\Models\Attendance;
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




    public function montlyInout(): void
    {
        //352 is an admin user at Ingress system for grid fetching
        if (!Inout::whereYear('date', $this->actualYear)
            ->whereMonth('date', $this->actualMonth)
            ->exists()) {

            Attendance::where('userid', 352)
                ->whereYear('date',  $this->actualYear)
                ->whereMonth('date',  $this->actualMonth)
                ->get()
                ->map(function ($date) {

                    Personnel::all()->map(function ($user) use ($date) {
                        Inout::create([
                            'userid' => $user['userid'],
                            'date'   => $date->date
                        ]);
                    });
                });
        }
    }

    public  function newUserInout($userId): void
    {
        //352 is an admin user at Ingress system for grid fetching

        Attendance::where('userid', 352)
            ->whereYear('date',  $this->actualYear)
            ->whereMonth('date',  $this->actualMonth)
            ->get()
            ->map(function ($date) use ($userId) {

                Inout::create([
                    'userid' => $userId,
                    'date'   => $date->date,
                ]);
            });
    }



    public function dailyInout($date): void
    {
        Personnel::with('inout')->get()->map(function ($user) use ($date) {
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
