<?php

namespace App\Services\Statistics;


class AttResumeFactory extends InoutCreator

{
    protected function factoryMethod($userid, $date)
    {
        $attResume = new AttResume();
        return ($attResume->getAtt($userid, $date));
    }

  
}
