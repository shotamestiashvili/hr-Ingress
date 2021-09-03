<?php

namespace App\Services\Statistics;


abstract class FetcherCreator

{

    protected abstract function factoryFetcher($userid, $year, $month);

   
    public function startFactoryFetcher($userid, $year, $month)
    {
        $att = $this->factoryFetcher($userid, $year, $month);
        return $att;
    }
}
