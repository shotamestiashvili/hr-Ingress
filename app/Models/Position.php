<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'position_name',
        'description',
        'code',
        'salary',
        'job_description',
        'experiance',
        'note',
        'cost_center',
        'confirmation',
        'no_confirmation',
        'epl_count',
    ];
}
