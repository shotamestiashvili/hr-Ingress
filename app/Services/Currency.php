<?php

namespace App\Services;

use GuzzleHttp;
use GuzzleHttp\Client;

class Currency
{

    public static function currency()
    {
        $url = "https://nbg.gov.ge/gw/api/ct/monetarypolicy/currencies/ka/json";

        $client = new GuzzleHttp\Client();
        $responce = $client->request('GET', $url)->getBody();

        $responceCollection =  collect(json_decode($responce));

        return $responceCollection->map(function($currencies)
        {
            return $currencies->currencies['40']->rateFormated;

        });

    }
}
