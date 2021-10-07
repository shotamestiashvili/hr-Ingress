<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PersonnelResource;
use App\Models\Personnel;
use App\Services\Creator;
use App\Services\Reference\Holiday\CreateHoliday;
use App\Services\Reference\Holiday\UpdateHoliday;
use App\Services\Updater;
use App\Services\Workdone\CreateMso;
use Illuminate\Http\Request;

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
}
