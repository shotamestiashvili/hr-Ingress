<?php

namespace App\Services\Statistics;

use App\Http\Interfaces\InoutInterface;
use App\Models\Attendance;

class AttOut implements InoutInterface
{

    private $att_out;

    public function getAtt($userid, $date)
    {

        $this->att_out =  Attendance::where('userid', $userid)
            ->where('date',   $date)
            ->value('att_out');

        return $this->att_out;
    }
}
