<?php

namespace App\Services\Statistics;


class AttInFactory extends InoutCreator

{
    protected function factoryMethod($userid, $date)
    {
        $attIn = new AttIn();
        return ($attIn->getAtt($userid, $date));
    }

   
}
