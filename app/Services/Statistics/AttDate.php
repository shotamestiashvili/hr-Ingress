<?php

namespace App\Services\Statistics;

use App\Http\Interfaces\InoutInterface;
use App\Http\Interfaces\MonthlyFetcherInterface;
use App\Models\Attendance;


Class AttDate implements MonthlyFetcherInterface {

    private $att_date;

    public function fetcher($userid, $year, $month)
    {

        $this->att_date =  Attendance::where('userid', $userid)
                                      ->whereYear('date',  $year)
                                      ->whereMonth('date', $month)
                                      ->value('date');
                                      return $this->att_date;
    }

}
