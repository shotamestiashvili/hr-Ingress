<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Services\Updater;
use App\Services\Creator;
use App\Services\Reference\Department\CreateDepartment;
use App\Services\Reference\Department\UpdateDepartment;

class DepartmentController extends Controller
{
    public function create (Request $request)
    {
        Department::create([
            'department' => $request->department,
            'code' => $request->code,
        ]);
    }

    public function index()
    {
        $showData= Department::all();
        return     DepartmentResource::collection($showData);
    }

    public function store(Request $request)
    {
        if ($request->id) {
            (new Updater((new UpdateDepartment()), $request));
        } else {
            (new Creator((new CreateDepartment()), $request));
        }
    }
    public function destroy($id)
    {
        Department::where('id', $id)->delete();
    }

}
