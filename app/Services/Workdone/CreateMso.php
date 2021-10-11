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
        $startTime = Carbon::parse($request->startdate. ' '. $request->starttime);
        $endTime =  Carbon::parse($request->enddate. ' '. $request->endtime);

        $totalDuration =  $startTime->diff($endTime)->format('%H:%I');

        Mso::create([
            'userid' => $request->selectedPersonnel,
            'mso_position' => $request->selectedPosition,
            'position' => Personnel::where('userid', $request->selectedPersonnel)->value('position'),
            'startdate' => $request->startdate,
            'starttime' => $request->starttime,
            'breaktime' => $request->breaktime,
            'enddate' => $request->enddate,
            'endtime' => $request->endtime,
            'type' => $request->type,
            'description' => $request->description,
            'total_hours' =>  $totalDuration,
//                Carbon::parse($request->starttime)->diff($request->endtime)->format('%H:%I'),
        ]);
    }

}
