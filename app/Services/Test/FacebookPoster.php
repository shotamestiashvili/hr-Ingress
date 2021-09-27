<?php

namespace App\Services\Test;

use App\Services\Test\SocialNetworkConnector;

class  FacebookPoster implements SocialNetworkConnector


{
    public function login();
    public function logout();
    public function createPost($content);

}
