<?php

namespace App\Services\Reference\Contract;

use App\Http\Interfaces\CreatorInterface;
use App\Models\Contract;

class CreateContract implements CreatorInterface
{
    public function create ($request)
    {
        Contract::create([
            'contract_type' => $request->contract_type,
            'end_date_is_mandatory' => $request->end_date_is_mandatory,
        ]);
    }
}
