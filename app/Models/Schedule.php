<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'userid',
        'honorMinutes',
        'selectedAbsence',
        'selectedDay',
        'selectedMonth',
        'selectedYear',
        'selectedPosition',
        'selectedWorktype',
    ];

}
