<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $fillable = [
        'userid',
        'date',
        'earlyIn',
        'delayIn',
        'lateOut',
        'earlyOut',
    ];

    public function inout()
    {
        return $this->belongsTo(Inout::class, 'userid', 'userid')->where('date', $this->date);
    }
}
