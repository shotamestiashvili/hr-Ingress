<?php

namespace App\Models;

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
        return $this->hasMany(Personnel::class, 'userid', 'userid');
    }

    public function schedule()
    {
        return $this->hasMany(Schedule::class, 'userid', 'userid')->where('date', $this->date);
    }

    public function statistic()
    {
        return $this->hasMany(Statistic::class, 'userid', 'userid')->where('date', $this->date);
    }


}
