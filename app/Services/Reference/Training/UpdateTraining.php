<?php

namespace App\Services\Reference\Training;

use App\Http\Interfaces\UpdaterInterface;
use App\Models\Training;

class UpdateTraining implements UpdaterInterface
{
    public function update ($request)
    {
        Training::where('id', $request->id)
              ->update([
                'training' => $request->training,
        ]);
    }
}
