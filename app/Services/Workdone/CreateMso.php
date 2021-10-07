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
        Mso::create([
            'userid' => $request->selectedPersonnel,
            'mso_position' => $request->selectedPosition,
            'position' => Personnel::where('userid', $request->selectedPersonnel)->value('position'),
            'starttime' => $request->starttime,
            'breaktime' => $request->breaktime,
            'endtime' => $request->endtime,
            'type' => $request->type,
            'description' => $request->description,
            'date' => $request->date,
            'total_hours' => Carbon::parse($request->starttime)->diff($request->endtime)->format('%H:%I'),
        ]);
    }

}
