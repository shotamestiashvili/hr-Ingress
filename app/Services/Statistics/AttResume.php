<?php

namespace App\Services\Statistics;

use App\Http\Interfaces\InoutInterface;
use App\Models\Attendance;

Class AttResume implements InoutInterface {

    private $att_resume;

    public function getAtt($userid, $date)
    {

        $this->att_resume =  Attendance::where('userid', $userid)
                                      ->where('date',   $date)
                                       ->pluck('att_resume');

                                   return $this->att_resume;
    }

}
