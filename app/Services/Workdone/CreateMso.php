<?php

namespace App\Services\Workdone;


use App\Http\Interfaces\CreatorInterface;
use App\Models\Mso;
use App\Models\Personnel;
use Carbon\Carbon;


class CreateMso implements CreatorInterface
{

    public function create($request)
    {
        $startDate = Carbon::parse( ($request->startdate))->format('Y-m-d');
        $endDate   = Carbon::parse( ($request->enddate))->format('Y-m-d');
        $starttime = $request->starttime['HH'].':'.$request->starttime['mm'];
        $endtime   = $request->endtime['HH'].':'. $request->endtime['mm'];
        $breaktime = $request->breaktime['HH'].':'. $request->breaktime['mm'];


        $startTime     = Carbon::createFromFormat('Y-m-d H:i',  $startDate.' '. $starttime);
        $endTime       = Carbon::createFromFormat('Y-m-d H:i',  $endDate.' '. $endtime);
        $breakTime     = Carbon::createFromFormat('Y-m-d H:i',  $startDate.' '.$breaktime);
        $breakTimeFrom = Carbon::createFromFormat('Y-m-d H:i',  $startDate.' '.'00:00');

        $minutes      = ($startTime->diffInMinutes($endTime));
        $breakMinute = ($breakTimeFrom->diffInMinutes($breakTime));

        $minute = $minutes - $breakMinute;

        $hoursFromMin      = intdiv( $minute, 60).':'. ( $minute % 60);

        $explodedFromMin = explode(':', $hoursFromMin);
        $hours  = $explodedFromMin[0];
        $minutes= $explodedFromMin[1];

        $totalDuration = $hours.':'.$minutes;

        Mso::create([
            'userid' => $request->selectedPersonnel,
            'mso_position'=> $request->selectedPosition,
            'position'    => Personnel::where('userid', $request->selectedPersonnel)->value('position'),
            'startdate'   => $startDate,
            'starttime'   => $starttime,
            'breaktime'   => $breaktime,
            'enddate'     => $endDate,
            'endtime'     => $endtime,
            'type'        => $request->type,
            'description' => $request->description,
            'total_hours' => $totalDuration,

        ]);
    }

}
