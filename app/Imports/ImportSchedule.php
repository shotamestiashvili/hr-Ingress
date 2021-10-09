<?php

namespace App\Imports;

use App\Models\Schedule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportSchedule implements  ToModel, WithChunkReading
{
    use Importable;

    public function model(array $row)
    {
        return new Schedule([
            'row1' => $row[1],
            'row2' => $row[2],
            'row3' => $row[3],
            'row4' => $row[4],
            'row5' => $row[5],
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }


}
