<?php

namespace App\Http\Controllers\Api;

use App\Exports\ExportPersonnel;
use App\Exports\ExportWorktype;
use App\Exports\ExportPosition;
use App\Exports\ExportSchedule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromQuery;

class ExportController extends Controller
{
    public function exportPersonnel()
    {
        return Excel::download(new ExportPersonnel, 'personnel_list.xlsx');
    }

    public function exportWorktype()
    {
        return Excel::download(new ExportWorktype, 'worktype_list.xlsx');
    }

    public function exportPosition()
    {
        return Excel::download(new ExportPosition, 'position_list.xlsx');
    }

    public function exportSchedule(Request $request)
    {
        return Excel::download(new ExportSchedule(
            $request->selectedDep,
            $request->selectedYear,
            $request->selectedMonth,
        ), 'schedule.xlsx');

    }


}
