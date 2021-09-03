<?php

namespace App\Services\Reference\Position;

use App\Http\Interfaces\CreatorInterface;
use App\Models\Position;

class CreatePosition implements CreatorInterface
{
    public  function create ($request)
    {
        Position::create([
            'position_name' => $request->position_name,
            'description' => $request->description,
            'code' => $request->code,
            'salary' => $request->salary,
            'job_description' => $request->job_description,
            'experiance' => $request->experiance,
            'note' => $request->note,
            'cost_center' => $request->cost_center,
            'confirmation' => $request->confirmation,
            'no_confirmation' => $request->no_confirmation,
            'epl_count' => $request->epl_count,
        ]);
    }
}
