<?php

namespace App\Services\Statistics;

use App\Http\Interfaces\InoutInterface;
use App\Models\Attendance;


Class AttBreak implements InoutInterface {

    private $att_break;

    public function getAtt($userid, $date)
    {

        $this->att_break =  Attendance::where('userid', $userid)
                                      ->where('date',   $date)
                                      ->value('att_break');

                                      return $this->att_break;
    }

}
