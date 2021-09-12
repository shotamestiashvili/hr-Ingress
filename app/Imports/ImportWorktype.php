<?php

namespace App\Imports;

use App\Models\Worktype;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ImportWorktype implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Worktype([
            'code'=> $row['code'],
            'start' => $row['start'],
            'end' => $row['end'],
            'hours' => $row['hours'],
            'in24hours' => $row['in24hours'],
        ]);
    }


    public function headingRow(): int
     {
         return 1;
     }
}
