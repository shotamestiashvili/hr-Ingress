<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HolidayResource;
use App\Models\Holiday;
use Illuminate\Http\Request;
use App\Services\Updater;
use App\Services\Creator;
use App\Services\Reference\Holiday\CreateHoliday;
use App\Services\Reference\Holiday\UpdateHoliday;

class HolidayController extends Controller
{
    public function create(Request $request)
    {
        Holiday::create([
            'holiday_name' => $request->holiday_name,
            'date' => $request->date,
        ]);
    }

    public function index()
    {
        $showData= Holiday::orderByDesc('created_at')->get();
        return     HolidayResource::collection($showData);
    }

    public function store(Request $request)
    {
        if ($request->id) {
            (new Updater((new UpdateHoliday()), $request));
        } else {
            (new Creator((new CreateHoliday()), $request));
        }
    }

    public function destroy($id)
    {
        Holiday::where('id', $id)->delete();
    }
}
