<?php

namespace App\Exports;

use App\Models\Personnel;
use App\Services\Accounting\MSO\MsoCalculation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportMso implements FromCollection, WithMapping, WithHeadings, WithStyles
{

    public function collection()
    {
        return   Personnel::with('msos')->get();
    }

    public function map($personnel): array
    {
        $msoHourCalc = new MsoCalculation();
        $informationalArrya = [
            $personnel->first_name . ' ' . $personnel->last_name,
            $personnel->position,
            $msoHourCalc->msoHours($personnel->userid, 2021, 1),
            $msoHourCalc->msoHours($personnel->userid, 2021, 2),
            $msoHourCalc->msoHours($personnel->userid, 2021, 3),
            $msoHourCalc->msoHours($personnel->userid, 2021, 4),
            $msoHourCalc->msoHours($personnel->userid, 2021, 5),
            $msoHourCalc->msoHours($personnel->userid, 2021, 6),
            $msoHourCalc->msoHours($personnel->userid, 2021, 7),
            $msoHourCalc->msoHours($personnel->userid, 2021, 8),
            $msoHourCalc->msoHours($personnel->userid, 2021, 9),
            $msoHourCalc->msoHours($personnel->userid, 2021, 10),
            $msoHourCalc->msoHours($personnel->userid, 2021, 11),
            $msoHourCalc->msoHours($personnel->userid, 2021, 12),
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
