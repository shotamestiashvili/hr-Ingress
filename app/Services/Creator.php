<?php

namespace App\Services;


use App\Http\Interfaces\CreatorInterface;

class Creator
{
    public function __construct(CreatorInterface $creater, $object)
    {
      $creater->create($object);
    }
}
