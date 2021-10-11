<?php

namespace App\Exports;

use App\Models\Personnel;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportSchedule implements FromCollection, WithMapping, WithHeadings, WithStyles
{
    public $userid;
    public $year;
    public $month;
    public $monthdays;


    public function __construct($department, $year, $month)
    {
        $this->department = $department;
        $this->year = $year;
        $this->month = $month;
        $this->monthdays = Carbon::create($this->year, $this->month)->daysInMonth +1;
    }

    public function collection()
    {
        return Personnel::with(['schedule'])
            ->where('department', $this->department)
            ->get();
    }

    public function map($personnel): array
    {
            $informationalArrya = [
                $personnel->userid,
                $personnel->department,
                $personnel->first_name . ' ' . $personnel->last_name,
        ];

        return $informationalArrya;

    }

    public function headings(): array
    {
        $informationalArrya = [
            'Userid',
            'Department',
            'Name',
        ];

        for($i=1; $i < $this->monthdays; $i++){
            array_push($informationalArrya,  $i.Carbon::create($this->year, $this->month, $i)->shortDayName,);
        }

        return $informationalArrya;
    }

    public function styles(Worksheet $worksheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],

        ];
    }

}
