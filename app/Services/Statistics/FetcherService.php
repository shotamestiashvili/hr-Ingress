<?php

namespace App\Services\Statistics;

use App\Models\Attendance;
use App\Services\Statistics\AttDateFactory;



class FetcherService
{

    public $att_date;

    public function __construct($userid, $year, $month)
    {
        // // $this->attDateFactoryobject = new AttDateFactory();
        // $this->att_date = (new AttDateFactory())->startFactoryFetcher($userid, $year, $month);

        $this->att_date =  Attendance::where('userid', $userid)
        ->whereYear('date',  $year)
        ->whereMonth('date', $month)
        ->value('date');
        return $this->att_date;

    }

}
