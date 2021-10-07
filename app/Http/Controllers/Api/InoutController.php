<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InoutResource;
use App\Models\Inout;
use App\Services\DateTime\DateTimeFormater;
use App\Services\Statistics\AttendanceService;
use App\Services\TimeCalculator\StatisticGenerator;
use Carbon\Carbon;


class InoutController extends Controller
{
    public function index()
    {
        if(request('row') == ''){
            $row = 31;
        }else{
            $row = request('row');
        }
        $inout = Inout::when(request('search') != '', function ($query) use ($row) {
            return  $query->where('userid', 'LIKE', '%' . request('search') . '%')
                ->orWhere('date', 'LIKE', '%' . request('search') . '%')
                ->orderBy('updated_at', "desc")
                ->paginate($row);
        })
            ->when(request('search') == '', function ($query) use ($row) {
                return $query->orderBy('updated_at', "desc")->paginate($row);
            });

        return  InoutResource::collection($inout);

    }

    public function newUserInout($userid): void
    {
        $attendanceServicenew = new AttendanceService();
        $attendanceServicenew->newUserInout($userid);
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


}
