<?php

namespace App\Imports;

use App\Models\Personnel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ImportPersonnel implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Personnel([
            'userid' => $row['code'],
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'personal_id' => $row['personal_id'],
            'birth_day' => $row['date_of_birth'],
            'gender' => $row['gender'],
            'address' => $row['address'],
            'retirement' => $row['retirement_age'],
            'family_status' => $row['family_status'],
            'education' => $row['education'],
            'contact_info' => $row['contact_info'],
            'position' => $row['current_position'],
            'department' => $row['department'],
            'head' => $row['head'],
            'subordinate_stuff' => $row['subordinate_stuff'],
            'military_info' => $row['military_info'],
            'phone' => $row['phone'],
            'email' => $row['email'],
            'registration_date' => $row['registration_date'],
            'author' => $row['author'],
        ]);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
