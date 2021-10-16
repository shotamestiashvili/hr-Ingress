<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MsoResource;
use App\Http\Resources\PersonnelResource;
use App\Models\Mso;
use App\Models\Personnel;
use App\Services\Creator;
use App\Services\Reference\Holiday\CreateHoliday;
use App\Services\Reference\Holiday\UpdateHoliday;
use App\Services\Updater;
use App\Services\Workdone\CreateMso;
use Illuminate\Http\Request;
use App\Services\Accounting\MSO\MsoCalculation;

class MsoController extends Controller
{
    public function index(): object
    {
        $personnel = Personnel::get();

        return PersonnelResource::collection($personnel);
    }

    public function store(Request $request)
    {
         new Creator((new CreateMso()), $request);

    }

    public function show(Request $request)
    {

        $row = $request->row;
//        $personnel = Personnel::with('msos')->paginate($request->row);

        $personnel = Personnel::with('msos')
            ->when(request('search') != '', function ($query) use ($row) {
                return $query->where('first_name', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('last_name', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('department', 'LIKE', '%' . request('search') . '%')
                    ->paginate($row);

            })->when(request('search') == '', function ($query) use ($row) {
                return $query->paginate($row);
            });
        return MsoResource::collection($personnel);
    }
}
