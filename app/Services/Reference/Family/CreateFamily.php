<?php

namespace App\Services\Reference\Family;

use App\Http\Interfaces\CreatorInterface;
use App\Models\Familystatus;

class CreateFamily implements CreatorInterface
{
    public function create ($request)
    {
        Familystatus::create([
            'family_status' => $request->family_status,
        ]);
    }
}
