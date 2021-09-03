<?php

namespace App\Services\Reference\Salarydate;

use App\Http\Interfaces\CreatorInterface;
use App\Models\Salarydate;

class CreateSalarydate implements CreatorInterface
{
    public function create ($request)
    {
        Salarydate::create([
            'salary_date' => $request->salary_date,
        ]);
    }
}
