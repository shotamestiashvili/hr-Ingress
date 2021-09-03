<?php

namespace App\Services\Reference\Holiday;

use App\Http\Interfaces\UpdaterInterface;
use App\Models\Holiday;

class UpdateHoliday implements UpdaterInterface
{
    public  function update ($request)
    {
        Holiday::where('id', $request->id)
              ->update([
                'holiday_name' => $request->holiday_name,
                'date' => $request->date,
        ]);
    }
}
