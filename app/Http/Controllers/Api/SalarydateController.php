<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SalarydateResource;
use App\Models\Salarydate;
use Illuminate\Http\Request;
use App\Services\Updater;
use App\Services\Creator;
use App\Services\Reference\Salarydate\CreateSalarydate;
use App\Services\Reference\Salarydate\UpdateSalarydate;

class SalarydateController extends Controller
{

    public function index()
    {
        $showData= Salarydate::all();
        return     SalarydateResource::collection($showData);
    }

    public function store(Request $request)
    {
        if ($request->id) {
            (new Updater((new UpdateSalarydate()), $request));
        } else {
            (new Creator((new CreateSalarydate()), $request));
        }
    }

    public function destroy($id)
    {
        Salarydate::where('id', $id)->delete();
    }
}
