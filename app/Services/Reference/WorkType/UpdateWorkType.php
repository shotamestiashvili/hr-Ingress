<?php

namespace App\Services\Reference\Worktype;

use App\Http\Interfaces\UpdaterInterface;
use App\Models\Worktype;

class UpdateWorktype implements UpdaterInterface
{
    public function update ($request)
    {
        Worktype::where('id', $request->id)
              ->update([
                'code' => $request->code,
                'start' => $request->start,
                'end' => $request->end,
                'hours' => $request->hours,
        ]);
    }
}
