<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MsoResource;
use App\Http\Resources\OvertimeResource;
use App\Http\Resources\PersonnelResource;

use App\Models\Personnel;
use App\Services\Creator;
use App\Services\Workdone\CreateMso;
use Illuminate\Http\Request;


class OvertimeController extends Controller
{
    public function index(): object
    {
        $personnel = Personnel::get();
        return PersonnelResource::collection($personnel);
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
        return OvertimeResource::collection($personnel);
    }
}
