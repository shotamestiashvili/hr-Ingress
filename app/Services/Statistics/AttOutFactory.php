<?php

namespace App\Services\Statistics;


class AttOutFactory extends InoutCreator

{
    protected function factoryMethod($userid, $date)
    {
        $attOut = new AttOut();
        return ($attOut->getAtt($userid, $date));
    }


}
