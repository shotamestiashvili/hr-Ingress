<?php

namespace App\Exports;

use App\Models\Personnel;
use App\Services\Accounting\MSO\MsoCalculation;
use App\Services\Accounting\Overtime\OvertimeCalculation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportOvertime implements FromCollection, WithMapping, WithHeadings, WithStyles
{

    public function collection()
    {
        return   Personnel::with('msos')->get();
    }

    public function map($personnel): array
    {
        $overtimeHourCalc = new OvertimeCalculation();
        $informationalArrya = [
            $personnel->first_name . ' ' . $personnel->last_name,
            $personnel->position,
            $overtimeHourCalc->overtimeHours($personnel->userid, 2021, 1),
            $overtimeHourCalc->overtimeHours($personnel->userid, 2021, 2),
            $overtimeHourCalc->overtimeHours($personnel->userid, 2021, 3),
            $overtimeHourCalc->overtimeHours($personnel->userid, 2021, 4),
            $overtimeHourCalc->overtimeHours($personnel->userid, 2021, 5),
            $overtimeHourCalc->overtimeHours($personnel->userid, 2021, 6),
            $overtimeHourCalc->overtimeHours($personnel->userid, 2021, 7),
            $overtimeHourCalc->overtimeHours($personnel->userid, 2021, 8),
            $overtimeHourCalc->overtimeHours($personnel->userid, 2021, 9),
            $overtimeHourCalc->overtimeHours($personnel->userid, 2021, 10),
            $overtimeHourCalc->overtimeHours($personnel->userid, 2021, 11),
            $overtimeHourCalc->overtimeHours($personnel->userid, 2021, 12),
        ];

        return $informationalArrya;

    }

    public function headings(): array
    {
        return [
            'Name',
            'Position' ,
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct' ,
            'Nov',
            'Dec',
        ];
    }

    public function styles(Worksheet $worksheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],

        ];
    }

}
