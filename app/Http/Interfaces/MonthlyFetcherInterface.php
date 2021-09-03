<?php

namespace App\Http\Interfaces;


interface MonthlyFetcherInterface {

    public function fetcher($userid, $year, $month);
}
