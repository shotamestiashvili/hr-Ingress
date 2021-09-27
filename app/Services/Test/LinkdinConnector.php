<?php

namespace App\Services\Test;


class  LinkdinConnector extends SocialNetworkPoster

{

    public $login, $password;

    public function __construct($login, $password)
    {
        $this->login   = $login;
        $this->password = $password;
    }


    public function getSocialNetwork(): SocialNetworkConnector
    {
        return new FacebookPoster($this->login, $this->password);
    }
}
