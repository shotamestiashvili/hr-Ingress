<?php

namespace App\Services\Reference\Salarydate;

use App\Http\Interfaces\UpdaterInterface;
use App\Models\Salarydate;

class UpdateSalarydate implements UpdaterInterface
{
    public function update ($request)
    {
        Salarydate::where('id', $request->id)
              ->update([
                'salary_date' => $request->salary_date,
        ]);
    }
}
