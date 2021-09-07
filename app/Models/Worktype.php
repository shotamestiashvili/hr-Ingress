<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worktype extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'start',
        'end',
        'hours',
        'in24hours',
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'code', 'selectedWorktype',);
    }
}
