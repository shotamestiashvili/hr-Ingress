<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inout extends Model
{
    protected $fillable = [
                'userid',
                'date',
                'att_in'    ,
                'att_break' ,
                'att_resume' ,
                'att_out',
    ];

    public function personnel()
    {
        return $this->belongsToMany(Personnel::class, 'userid', 'userid');
    }
}
