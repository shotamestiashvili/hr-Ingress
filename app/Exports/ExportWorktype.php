<?php

namespace App\Exports;

use App\Models\Worktype;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ExportWorktype implements FromCollection, WithHeadingRow
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Worktype::all();
    }

    public function headings(): array
    {
        return [
            'code',
            'start',
            'end',
            'hours'
        ];
    }
}
