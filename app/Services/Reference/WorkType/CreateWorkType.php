<?php

namespace App\Services\Reference\Worktype;

use App\Http\Interfaces\CreatorInterface;
use App\Models\Worktype;
use App\Services\DateTime\WorkTypeFormater;

class CreateWorktype implements CreatorInterface
{
    public function create($request)
    {
        $hoursObject = (new WorkTypeFormater($request->start, $request->end));
        Worktype::create([
            'code' => $request->code,
            'start' => $request->start,
            'end' => $request->end,
            'hours' => ($hoursObject)->worktypeHoursGen(),
            'in24hours' => $hoursObject->in24Hours($hoursObject->worktypeHoursGen())
        ]);
    }
}
