<?php

namespace App\Services\Test;

interface SocialNetworkConnector

{
    public function login();
    public function logout();
    public function createPost($content);
}
