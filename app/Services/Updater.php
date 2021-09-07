<?php

namespace App\Services;


use App\Http\Interfaces\UpdaterInterface;

class Updater
{
    public function __construct(UpdaterInterface $updater, $object)
    {
       $updater->update($object);
    }
}
