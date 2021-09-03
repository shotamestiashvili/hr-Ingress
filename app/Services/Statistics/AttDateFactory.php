<?php

namespace App\Services\Statistics;


class AttDateFactory extends FetcherCreator

{

    protected function factoryFetcher($userid, $year, $month)
    {
        $attDate= new AttDate();
        return ($attDate->fetcher($userid, $year, $month));
    }

    

}
