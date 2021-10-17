<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaidLeave extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'userid',
            'position',
            'yearly_balance',
            'leave_type',
            'leave_date',
        ];

    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'userid', 'userid');
    }
}
