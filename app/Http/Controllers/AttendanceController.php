<?php

namespace App\Http\Controllers;

use App\Http\Resources\InoutResource;
use App\Models\Inout;
use App\Models\Personnel;
use App\Models\Schedule;
use App\Models\Training;
use App\Models\Worktype;
use App\Services\DateTime\DateTimeFormater;
use App\Services\DateTime\HourCalculator;
use App\Services\DateTime\WorkTypeFormater;
use App\Services\Statistics\AttendanceService;
use App\Services\Statistics\InoutService;
use App\Services\TimeCalculator\In;
use App\Services\TimeCalculator\Out;
use App\Services\TimeCalculator\StatisticGenerator;
use App\Services\TimeCalculator\Time;
use App\Services\TimeCalculator\TimeConstructor;
use App\Services\TimeCalculator\TimeService;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceController extends Controller
{
    public function test()
    {


        $personnel = Personnel::with('inout')->get();

        $monthDays = Personnel::with('inout')->where('userid', 352)
        ->get()
        ->map(function($user){
            return $user->inout->map(function($inout){
                return $inout->date;
            })->count();
        });

            return Excel::raw('laravelcode', function($excel) use ($personnel, $monthDays) {
                $excel->sheet('mySheet', function($sheet) use ($personnel, $monthDays )
                {
                    $sheet->cell('A1', function($cell) {$cell->setValue('First Name');   });
                    $sheet->cell('B1', function($cell) {$cell->setValue('Last Name');   });
                    $sheet->cell('C1', function($cell) {$cell->setValue('Email');   });

                    if (!empty($data)) {
                        foreach ($personnel as $key => $value) {
                            $i= $key+2;
                            $sheet->cell('A'.$i, $value['first_name']);
                            $sheet->cell('B'.$i, $value['userid']);

                        }
                    }
                });
            })::download('xls');



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

    public function monthlyGrid()
    {
        $attendanceServicenew = new AttendanceService();
        $attendanceServicenew->montlyInout();
    }

    public function refresh()
    {
        $today =  (Carbon::now())->toDateTimeString();
        $attendanceServicenew = new AttendanceService();
        $attendanceServicenew->dailyInout(DateTimeFormater::date( $today ));
    }


    public function statisticGenerate()
    {
        $today =  (Carbon::now())->toDateTimeString();
        $attendanceServicenew = new StatisticGenerator();
        $attendanceServicenew->generate(DateTimeFormater::date($today));
    }

    public function newUserGrid()
    {
        $userid = 99999;
        $attendanceServicenew = new AttendanceService();
        $attendanceServicenew->newUserInout($userid);
    }




}
