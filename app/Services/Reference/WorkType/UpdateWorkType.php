<?php

namespace App\Services\Reference\Worktype;

use App\Http\Interfaces\UpdaterInterface;
use App\Models\Worktype;
use App\Services\DateTime\WorkTypeFormater;

class UpdateWorktype implements UpdaterInterface
{
    public function update($request)
    {
        $hoursObject = (new WorkTypeFormater($request->start, $request->end));
        Worktype::where('id', $request->id)
            ->update([
                'code' => $request->code,
                'start' => $request->start,
                'end' => $request->end,
                'hours' => ($hoursObject)->worktypeHoursGen(),
                'in24hours' => $hoursObject->in24Hours($hoursObject->worktypeHoursGen())
            ]);
    }
}
