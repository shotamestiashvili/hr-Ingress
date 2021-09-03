<?php

namespace App\Services\Reference\Education;

use App\Http\Interfaces\UpdaterInterface;
use App\Models\Education;

class UpdateEducation implements UpdaterInterface
{
    public function update ($request)
    {
        Education::where('id', $request->id)
              ->update([
                'education' => $request->education,
        ]);
    }
}
