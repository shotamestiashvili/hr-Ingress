<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mso extends Model
{
    use HasFactory;

    protected $fillable = [
        'userid',
        'position',
        'type',
        'mso_position',
        'date',
        'starttime',
        'endtime',
        'total_hours',
        'breaktime',
        ];

    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'userid', 'userid');
    }

}
