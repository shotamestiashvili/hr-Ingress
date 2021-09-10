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
        $inout = Inout::when(request('search') != '', function ($query) {
            return  $query->where('userid', 'LIKE', '%' . request('search') . '%')
                ->orWhere('date', 'LIKE', '%' . request('search') . '%')
                ->orderBy('updated_at', "desc")
                ->paginate(31);
        })
            ->when(request('search') == '', function ($query) {
                return $query->orderBy('updated_at', "desc")->paginate(31);
            });

        return  InoutResource::collection($inout);

    }

    public function newUserInout($userid): void
    {
        $attendanceServicenew = new AttendanceService();
        $attendanceServicenew->newUserInout($userid);
    }

    public function montlyInout(): void
    {
        $attendanceServicenew = new AttendanceService();
        $attendanceServicenew->montlyInout();
    }

    public function refresh(): void
    {
        $attendanceServicenew = new AttendanceService();
        $attendanceServicenew->dailyInout(DateTimeFormater::date('2021-09-04'));
    }

    public function generate()
    {
        $attendanceServicenew = new StatisticGenerator();
       return $attendanceServicenew->generate(DateTimeFormater::date('2021-9-4'));
    }

}
