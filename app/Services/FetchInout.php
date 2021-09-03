<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\Inout;
use Carbon\Carbon;


class FetchInout extends ActualDate
{

    public static function fetchInout()
    {
        new FetchInout(new Attendance(), new Inout());
    }

    private function __construct(Attendance $attendance, Inout $inout)
    {
        $this->createYearlyGrid($attendance, $inout);
        $this->createMonthlyGrid($attendance, $inout);
        $this->updateMonthlyGrid($attendance, $inout);
    }


    public $useridArray = ['352', '339'];


    private function createYearlyGrid(Attendance $attendance, Inout $inout): void
    {
        $useridArray = $this->useridArray;

        if ($this->getInoutLastRecordDate()->year !==  $this->getAttLastRecordDate()->year) {
            $attendance->whereYear('date', $this->getAttLastRecordDate()->year)
                ->get()
                ->filter(function ($yearlyAtt) use ($useridArray) {
                    return collect($useridArray)->contains($yearlyAtt['userid']);
                })->map(function ($attendance) use ($inout) {
                    $inout->create([
                        'userid'     => $attendance->userid,
                        'date'       => $attendance->date,
                        'att_in'     => $attendance->att_in,
                        'att_break'  => $attendance->att_break,
                        'att_resume' => $attendance->att_resume,
                        'att_out'    => $attendance->att_out,
                    ]);
                });
        }
    }


    private function createMonthlyGrid(Attendance $attendance, Inout $inout): void
    {
        $useridArray = $this->useridArray;

        if ($this->getInoutLastRecordDate()->month !== $this->getAttLastRecordDate()->month) {

            $attendance->whereMonth('date', $this->getAttLastRecordDate()->month)
                ->whereYear('date', $this->getAttLastRecordDate()->year)
                ->get()
                ->filter(function ($monthlyAtt) use ($useridArray) {
                    return collect($useridArray)->contains($monthlyAtt['userid']);
                })->map(function ($attendance) use ($inout) {
                    $inout->where('userid', $attendance->userid)
                          ->create([
                            'userid'     => $attendance->userid,
                            'date'       => $attendance->date,
                            'att_in'     => $attendance->att_in,
                            'att_break'  => $attendance->att_break,
                            'att_resume' => $attendance->att_resume,
                            'att_out'    => $attendance->att_out,
                        ]);
                });
        }
    }



    private function updateMonthlyGrid(Attendance $attendance, Inout $inout): void
    {
        $useridArray = $this->useridArray;

        $attendance->whereMonth('date', $this->getAttLastRecordDate()->month)
            ->get()
            ->filter(function ($monthlyAtt) use ($useridArray) {
                return collect($useridArray)->contains($monthlyAtt['userid']);
            })->map(function ($attendance) use ($inout) {

                $inout->where('userid', $attendance->userid)
                      ->where('date', $attendance->date)
                      ->update([
                        'att_in'     => $attendance->att_in,
                        'att_break'  => $attendance->att_break,
                        'att_resume' => $attendance->att_resume,
                        'att_out'    => $attendance->att_out,
                    ]);
            });
    }



    private function  getInoutLastRecordDate(): object
    {
        return new Carbon(Inout::orderByDesc('created_at')
            ->pluck('date')
            ->first());
    }

    private function  getAttLastRecordDate(): object
    {
        return new Carbon(Attendance::orderByDesc('createdate')
            ->pluck('date')
            ->first());
    }
}
