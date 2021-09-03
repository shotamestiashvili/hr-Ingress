<?php

namespace App\Services\Reference\Education;

use App\Http\Interfaces\CreatorInterface;
use App\Models\Education;

class CreateEducation implements CreatorInterface
{
    public  function create ($request)
    {
        Education::create([
            'education' => $request->education,
        ]);
    }
}
