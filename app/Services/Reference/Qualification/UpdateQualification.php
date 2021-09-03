<?php

namespace App\Services\Reference\Qualification;

use App\Http\Interfaces\UpdaterInterface;
use App\Models\Qualification;

class UpdateQualification implements UpdaterInterface
{
    public function update ($request)
    {
        Qualification::where('id', $request->id)
              ->update([
                'qualification' => $request->qualification,
        ]);
    }
}
