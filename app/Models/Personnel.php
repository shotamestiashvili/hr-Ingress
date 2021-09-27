<?php

namespace App\Models;

use App\Models\Schedule as ModelsSchedule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Personnel extends Model
{
    protected $fillable = [
            'userid',
            'first_name',
            'last_name',
            'personal_id',
            'birth_day',
            'gender',
            'address',
            'retirement',
            'family_status',
            'education',
            'contact_info',
            'position',
            'department',
            'head',
            'subordinate_stuff',
            'military_info',
            'phone',
            'email',
            'registration_date',
            'author',
            'food',
            'ensuarence',
            'additional',
            'bank_account',
            'companyid',
            'additional',
            'avatar_url',
    ];


    public function inout()
    {
        return $this->hasMany(Inout::class, 'userid', 'userid');
    }

    public function schedule()
    {
        return $this->hasMany(Schedule::class, 'userid', 'userid');
    }

}
