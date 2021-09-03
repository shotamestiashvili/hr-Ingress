<?php

namespace App\Services\Statistics;


use App\Services\Statistics\AttDateFactory;



class FetcherService
{

    public $att_date;

    public function __construct($userid, $year, $month)
    {
        // $this->attDateFactoryobject = new AttDateFactory();
        $this->att_date = (new AttDateFactory())->startFactoryFetcher($userid, $year, $month);

    }

}
