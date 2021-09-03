<?php

namespace App\Services\Reference\Department;

use App\Http\Interfaces\CreatorInterface;
use App\Models\Department;

class CreateDepartment implements CreatorInterface
{
    public  function create ($request)
    {
        Department::create([
            'department' => $request->department,
            'code' => $request->code,
        ]);
    }
}
