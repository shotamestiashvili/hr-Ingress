<?php

namespace  App\Services\Test;
use App\Services\Test\SocialNetworkConnector;

abstract class SocialNetworkPoster
{
    abstract function getSocialNetwork() : SocialNetworkConnector;


    public function post($content)
    {
        $socialNetwork = $this->getSocialNetwork();

        $socialNetwork->login();
        $socialNetwork->createPost($content);
        $socialNetwork->logout();

    }


}
