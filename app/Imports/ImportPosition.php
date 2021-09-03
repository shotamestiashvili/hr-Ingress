<?php

namespace App\Imports;

use App\Models\Position;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportPosition implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Position([
            'position_name' => $row[0],
            'description' => $row[1],
            'code' => $row[2],
            'salary' => $row[3],
            'job_description' => $row[4],
            'experiance' => $row[5],
            'note' => $row[6],
            'cost_center' => $row[7],
            'confirmation' => $row[8],
            'no_confirmation' => $row[9],
            'epl_count' => $row[10],
        ]);
    }


    public function headingRow(): int
    {
        return 2;
    }
}
