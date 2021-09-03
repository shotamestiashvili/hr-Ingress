<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleResource;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Services\Updater;
use App\Services\Creator;
use App\Services\Schedule\CreateSchedule;
use App\Services\Schedule\UpdateSchedule;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Object
    {
        $schedule = Schedule::when(request('userid') != '', function ($query) {

            return $query->where('userid', request('userid'))
            ->where('selectedDay', request('selectedDay'))
            ->where('selectedMonth', request('selectedMonth'))
            ->where('selectedYear', request('selectedYear'))
            ->get();

        })->when(request('userid') == '', function ($query) {
           return $query->where('selectedMonth', request('selectedMonth'))
            ->where('selectedYear', request('selectedYear'))
            ->get();
        });
        return ScheduleResource::collection($schedule);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): void
    {

        if (Schedule::where('userid', $request->userid)
                    ->where('selectedYear' , $request->selectedYear)
                    ->where('selectedMonth' , $request->selectedMonth)
                    ->where('selectedDay' , $request->selectedDay)
                    ->exists())
        {
            (new Updater((new UpdateSchedule()), $request));

        } else {
            (new Creator((new CreateSchedule()), $request));
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): void
    {
        Schedule::where('id', $id)->delete();
    }
}
