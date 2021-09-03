<?php

namespace App\Services\Reference\Absence;


use App\Http\Interfaces\CreatorInterface;
use App\Models\Absence;

class CreateAbsence implements CreatorInterface
{
    public function create($request)
    {
        Absence::create([
            'name' => $request->name,
            'percent_from_salary' => $request->percent_from_salary,
            'color' => $request->color,
            'nickname' => $request->nickname,
        ]);
    }
}
