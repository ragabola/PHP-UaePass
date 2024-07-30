<?php

namespace Ragab\DTOs;

readonly class UaeClient
{
    public function __construct(
        protected string $clientId,
        protected string $clientToken,
        protected string $redirectURL,
        protected string $local = 'en',
        protected bool $production = false
    )
    {
    }

    public function clientId()
    {
        return $this->clientId;
    }
    
    public function clientToken()
    {
        return $this->clientToken;
    }

    public function redirectURL()
    {
        $protocol = $this->production ? 'https' : 'http';
        return $protocol . $_SERVER['HTTP_HOST'] . '/' . trim($this->redirectURL, '/');
    }

    public function local()
    {
        return $this->local;
    }

    public function production()
    {
        return $this->production;
    }

}