<?php

namespace App\Exports;

use App\Models\Personnel;
use App\Models\Schedule;
use Facade\Ignition\QueryRecorder\Query;
use Faker\Provider\ar_JO\Person;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class ExportSchedule implements WithHeadings
{

    use Exportable;

    // public function query()
    // {
    //     return Personnel::query();
    // }

    public function map(Personnel $personnel)
    {
        [
            $personnel->map(function ($users) {
                return $users->userid;
            })
        ];
    }

    public function headings(): array
    {
        $userid = Personnel::get()->map(function ($users) {
            return $users->userid;
        });

        $value = $userid->map(function ($value) {
            return $value;
        });


    }
}
