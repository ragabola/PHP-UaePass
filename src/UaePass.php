<?php

namespace Ragab;

use Ragab\DTOs\UaeClient;
use Ragab\DTOs\UaeUser;
use Ragab\Services\AccessToken;
use Ragab\Services\URLBuilder;
use Ragab\Services\User;

class UaePass
{
    public function __construct(protected  UaeClient $client){}

    public static function fromClient(array $config)
    {
        return new self(new UaeClient(
            $config['clientId'],
            $config['clientToken'],
            $config['redirectURL'],
            $config['local'],
            $config['production']
        ));
    }

    public function login()
    {
        return header('Location: ' . URLBuilder::build($this->client)->login());
    }

    public function register()
    {
        return header('Location: ' . URLBuilder::build($this->client)->register());
    }

    public function user(string $code, string $state) : UaeUser
    {
        $token = AccessToken::for($this->client)->validateState($state)->get($code);
        return User::fromClient($this->client)->using($token)->get();
    }

    public function logout()
    {
        return header('Location: ' . URLBuilder::build($this->client)->logout());
    }
}