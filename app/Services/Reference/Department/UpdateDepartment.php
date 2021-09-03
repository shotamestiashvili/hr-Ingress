<?php

namespace App\Services\Reference\Department;

use App\Http\Interfaces\UpdaterInterface;
use App\Models\Department;

class UpdateDepartment implements UpdaterInterface
{
    public  function update ($request)
    {
        Department::where('id', $request->id)
              ->update([
                'department' => $request->department,
                'code' => $request->code,
        ]);
    }
}
