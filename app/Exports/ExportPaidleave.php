<?php

namespace App\Exports;

use App\Models\Personnel;
use App\Services\Accounting\MSO\MsoCalculation;
use App\Services\PaidLeave\PaidLeaveService;
use App\Services\SickLeave\SickLeaveService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportPaidleave implements FromCollection, WithMapping, WithHeadings, WithStyles
{

    public function collection()
    {
        return   Personnel::with('paidleave')->get();
    }

    public function map($personnel): array
    {

        $informationalArrya = [
            $personnel->first_name . ' ' . $personnel->last_name,
            $personnel->position,
            PaidLeaveService::PaidLeaveDays,
            PaidLeaveService::calcMonthlyWaste($personnel->userid, 2021, 1),
            PaidLeaveService::calcMonthlyWaste($personnel->userid, 2021, 2),
            PaidLeaveService::calcMonthlyWaste($personnel->userid, 2021, 3),
            PaidLeaveService::calcMonthlyWaste($personnel->userid, 2021, 4),
            PaidLeaveService::calcMonthlyWaste($personnel->userid, 2021, 5),
            PaidLeaveService::calcMonthlyWaste($personnel->userid, 2021, 6),
            PaidLeaveService::calcMonthlyWaste($personnel->userid, 2021, 7),
            PaidLeaveService::calcMonthlyWaste($personnel->userid, 2021, 8),
            PaidLeaveService::calcMonthlyWaste($personnel->userid, 2021, 9),
            PaidLeaveService::calcMonthlyWaste($personnel->userid, 2021, 10),
            PaidLeaveService::calcMonthlyWaste($personnel->userid, 2021, 11),
            PaidLeaveService::calcMonthlyWaste($personnel->userid, 2021, 12),
            PaidLeaveService::calcYearlyWaste($personnel->userid, 2021),
            PaidLeaveService::calcRemainDays($personnel->userid, 2021),
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
