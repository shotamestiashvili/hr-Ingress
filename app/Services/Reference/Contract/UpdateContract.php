<?php

namespace App\Services\Reference\Contract;

use App\Models\Contract;
use App\Http\Interfaces\UpdaterInterface;

class UpdateContract implements UpdaterInterface
{
    public function update ($request)
    {
        Contract::where('id', $request->id)
              ->update([
                'contract_type' => $request->contract_type,
                'end_date_is_mandatory' => $request->end_date_is_mandatory,
        ]);
    }
}
