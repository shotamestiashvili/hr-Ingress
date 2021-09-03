<?php

namespace App\Services\Reference\Worktype;

use App\Http\Interfaces\CreatorInterface;
use App\Models\Worktype;

class CreateWorktype implements CreatorInterface
{
    public function create ($request)
    {
        Worktype::create([
            'code' => $request->code,
            'start' => $request->start,
            'end' => $request->end,
            'hours' => $request->hours,
        ]);
    }
}
