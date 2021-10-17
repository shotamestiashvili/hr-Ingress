<?php

namespace App\Exports;

use App\Models\Personnel;
use App\Services\Accounting\MSO\MsoCalculation;
use App\Services\SickLeave\SickLeaveService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportSickleave implements FromCollection, WithMapping, WithHeadings, WithStyles
{

    public function collection()
    {
        return   Personnel::with('sickleave')->get();
    }

    public function map($personnel): array
    {

        $informationalArrya = [
            $personnel->first_name . ' ' . $personnel->last_name,
            $personnel->position,
            SickLeaveService::SickLeaveDays,
            SickLeaveService::calcMonthlyWaste($personnel->userid, 2021, 1),
            SickLeaveService::calcMonthlyWaste($personnel->userid, 2021, 2),
            SickLeaveService::calcMonthlyWaste($personnel->userid, 2021, 3),
            SickLeaveService::calcMonthlyWaste($personnel->userid, 2021, 4),
            SickLeaveService::calcMonthlyWaste($personnel->userid, 2021, 5),
            SickLeaveService::calcMonthlyWaste($personnel->userid, 2021, 6),
            SickLeaveService::calcMonthlyWaste($personnel->userid, 2021, 7),
            SickLeaveService::calcMonthlyWaste($personnel->userid, 2021, 8),
            SickLeaveService::calcMonthlyWaste($personnel->userid, 2021, 9),
            SickLeaveService::calcMonthlyWaste($personnel->userid, 2021, 10),
            SickLeaveService::calcMonthlyWaste($personnel->userid, 2021, 11),
            SickLeaveService::calcMonthlyWaste($personnel->userid, 2021, 12),
            SickLeaveService::calcYearlyWaste($personnel->userid, 2021),
            SickLeaveService::calcRemainDays($personnel->userid, 2021),
        ];

        return $informationalArrya;

    }

    public function headings(): array
    {
        return [
            'Name',
            'Position' ,
            'Total Allowed',
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
            'Total Used',
            'Total Balance',
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
