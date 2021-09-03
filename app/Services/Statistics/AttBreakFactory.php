<?php

namespace App\Services\Statistics;


class AttBreakFactory extends InoutCreator

{
    protected function factoryMethod($userid, $date)
    {
        $attBreak = new AttBreak();
        return ($attBreak->getAtt($userid, $date));
    }

   

}
