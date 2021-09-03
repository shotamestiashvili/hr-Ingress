<?php

namespace App\Services\Reference\Qualification;

use App\Http\Interfaces\CreatorInterface;
use App\Models\Qualification;

class CreateQualification implements CreatorInterface
{
    public function create ($request)
    {
        Qualification::create([
            'qualification' => $request->qualification,
        ]);
    }
}
