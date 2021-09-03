<?php

namespace App\Services\Reference\Training;

use App\Http\Interfaces\CreatorInterface;
use App\Models\Training;

class CreateTraining implements CreatorInterface
{
    public function create ($request)
    {
        Training::create([
            'training' => $request->training,
        ]);
    }
}
