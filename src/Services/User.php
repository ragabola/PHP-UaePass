<?php

namespace Ragab\Services;

use Ragab\DTOs\UaeClient;
use Ragab\DTOs\UaeUser;
use Ragab\Exceptions\AccessTokenException;

class User
{
    private $ch;
    public function __construct(protected UaeClient $client) {}

    public static function fromClient($client)
    {
        $instance = new self($client);

        return $instance;
    }

    public function using(string $accessToken)
    {
        $headers = [
            "Authorization Bearer {$accessToken}"
        ];

        $this->ch = curl_init();

        curl_setopt($this->ch, CURLOPT_URL, URLBuilder::build($this->client)->user());
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_POST, true);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, $this->client->production() ? true : false);

        return $this;
    }

    public function get()
    {
        $response = curl_exec($this->ch);

        if ($response === false) throw new AccessTokenException(curl_error($this->ch));
        else return UaeUser::fromUser(json_decode($response, true));
    }
}