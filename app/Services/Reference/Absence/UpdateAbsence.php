<?php

namespace App\Services\Reference\Absence;

use App\Http\Interfaces\UpdateReferenceInterface;
use App\Http\Interfaces\UpdaterInterface;
use App\Models\Absence;

class UpdateAbsence implements UpdaterInterface
{
    public function update ($request)
    {
        Absence::where('id', $request->id)
              ->update([
            'name' => $request->name,
            'percent_from_salary' => $request->percent_from_salary,
            'color' => $request->color,
            'nickname' => $request->nickname,
        ]);
    }
}
