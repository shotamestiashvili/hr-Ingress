<?php

namespace App\Http\Controllers\Api;

use App\Exports\ExportMso;
use App\Exports\ExportOvertime;
use App\Exports\ExportPaidleave;
use App\Exports\ExportPersonnel;
use App\Exports\ExportSickleave;
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

    public function exportMso(Request $request)
    {
        return Excel::download(new ExportMso(), 'mso.xlsx');
    }

    public function exportOvertime(Request $request)
    {
        return Excel::download(new ExportOvertime(), 'overtime.xlsx');
    }

    public function exportPaidleave(Request $request)
    {
        return Excel::download(new ExportPaidleave(), 'paidleave.xlsx');
    }

    public function exportSickleave(Request $request)
    {
        return Excel::download(new ExportSickleave(), 'sickleave.xlsx');
    }

}
