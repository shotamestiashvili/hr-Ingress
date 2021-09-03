<?php

namespace App\Services\Statistics;


abstract class InoutCreator

{
    protected abstract function factoryMethod($userid, $date);


    public function startFactory($userid, $date)
    {
        $att = $this->factoryMethod($userid, $date);
        return $att;
    }


}
