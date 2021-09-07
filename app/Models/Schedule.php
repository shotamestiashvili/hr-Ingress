<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'userid',
        'date',
        'honorMinutes',
        'selectedAbsence',
        'selectedDay',
        'selectedMonth',
        'selectedYear',
        'selectedPosition',
        'selectedWorktype',
    ];

    public function inout()
    {
        return $this->belongsTo(Inout::class, 'userid', 'userid')->where('date', $this->date);
    }


    public function worktype()
    {
        return $this->hasMany(Worktype::class, 'code', 'selectedWorktype');
    }
}
