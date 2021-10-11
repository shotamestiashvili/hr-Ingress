<?php

namespace App\Services\Reference\Holiday;

use App\Http\Interfaces\CreatorInterface;
use App\Models\Holiday;

class CreateHoliday implements CreatorInterface
{
    public function create ($request)
    {
        Holiday::create([
            'holiday_name' => $request->holiday_name,
            'date' => $request->date,
        ]);
    }

}
