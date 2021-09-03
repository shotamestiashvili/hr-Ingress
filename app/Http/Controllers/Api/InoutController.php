<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InoutResource;
use App\Models\Inout;
use App\Services\DateTime\DateTimeFormater;
use App\Services\Statistics\AttendanceService;

class InoutController extends Controller
{
    public function index()
    {
        $inout = Inout::when(request('search') != '', function ($query) {
            return $query->where('userid', 'LIKE', '%' . request('search') . '%')
                ->orWhere('date', 'LIKE', '%' . request('search') . '%')->paginate(30);
        })
            ->when(request('search') == '', function ($query) {
                return $query->paginate(30);
            });

        return InoutResource::collection($inout);
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
        $attendanceServicenew->dailyInout(DateTimeFormater::date('2021-9-1'));
    }
}
