<?php

namespace App\Services\Reference\Family;

use App\Http\Interfaces\UpdaterInterface;
use App\Models\Familystatus;

class UpdateFamily implements UpdaterInterface
{
    public function update ($request)
    {
        Familystatus::where('id', $request->id)
              ->update([
                'family_status' => $request->family_status,
        ]);
    }
}
