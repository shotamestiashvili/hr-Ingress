<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'userid',
        'worktype',
        'startdate',
        'starttime',
        'intime',
        'enddate',
        'endtime',
        'outtime',
    ];

    public function worktypes()
    {
        return $this->hasMany(Worktype::class, 'code', 'worktype');
    }
}
