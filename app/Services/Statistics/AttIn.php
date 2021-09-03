<?php

namespace App\Services\Statistics;

use App\Http\Interfaces\InoutInterface;
use App\Models\Attendance;

Class AttIn implements InoutInterface {

    private $att_in;

    public function getAtt($userid, $date)
    {

        $this->att_in =   Attendance::where('userid', $userid)
                                       ->where('date', $date)
                                       ->pluck('att_in');

                                       return $this->att_in;
    }

}
