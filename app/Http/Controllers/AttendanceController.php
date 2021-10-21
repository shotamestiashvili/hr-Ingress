<?php

namespace App\Http\Controllers;


use App\Http\Resources\MsoResource;
use App\Imports\ImportSchedule;
use App\Jobs\CreateOrUpdateSchedule;
use App\Jobs\ScheduleDateColumnFormater;
use App\Models\ActiveSchedule;
use App\Models\Personnel;
use App\Models\Worktype;
use App\Services\Accounting\MSO\MsoCalculation;
use App\Services\DateTime\DateTimeFormater;
use App\Services\DateTime\WorkTypeFormater;
use App\Services\PaidLeave\PaidLeave;
use App\Services\PaidLeave\PaidLeaveService;
use App\Services\Schedule\ScheduleArrayMaker;
use App\Services\Statistics\AttendanceService;
use App\Services\TimeCalculator\ActiveScheduleUpdater;
use App\Services\TimeCalculator\AttendanceFilter;
use App\Services\TimeCalculator\StatisticGenerator;
use App\Services\TimeCalculator\TimeConstructor;
use Carbon\Carbon;
use App\Models\Mso;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class AttendanceController extends Controller
{

    public function human()
    {

//        $paidLeave =  (new PaidLeaveService());

        return PaidLeaveService::calcRemainDays(352, '2021');
    }

    public function import(Request $request)
    {

//        Excel::import(new ImportSchedule(), $request->import_file);
//        return response()->json(['message' => 'uploaded successfully'], 200);

        $collection = Excel::toCollection(new ImportSchedule, $request->import_file);

        new CreateOrUpdateSchedule($collection, 2021, 10);
    }


    public function mso(Request  $request)
    {
        $personnel = Personnel::with('msos')->get();

        return MsoResource::collection($personnel);
    }


    public function timeService()
    {
        $time = new TimeConstructor(352, date('2021-09-09'));
//        return (new TimeService(133, date('2021-09-01')))->lateOut;

        return $time->in24;
    }


    public function worktypeTime()
    {
        $worktype = new Worktype();
        return $worktype->all()->map(function ($worktype) {
            $object = (new WorkTypeFormater($worktype['start'], $worktype['end']));
            $worktype->where('end', $worktype['end'])
                ->where('start', $worktype['start'])
                ->update([
                    'in24hours' => $object->in24Hours($object->worktypeHoursGen())
                ]);
        });
    }

    public function dailyInout()
    {
        $att = new AttendanceService();
        $att->dailyInout();
    }

    public function monthlyInout()
    {
        $att = new AttendanceService();
        $att->monthlyInout();
    }

    public function monthlyGrid()
    {
        $att = new AttendanceService();
        $att->monthlyGrid();
    }

    public function dailyGenerate()
    {
        $statistic = new  StatisticGenerator();
        $statistic->generateDaily();
    }

    public function monthlyGenerate()
    {
        $statistic = new  StatisticGenerator();
        $statistic->generateMonthly();
    }

    public function attendanceFilter()
    {
        $attendanceFilter = new  AttendanceFilter();
        $attendanceFilter->humanAttendanceRunnerMonthly();
    }


}
