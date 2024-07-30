<?php

namespace Ragab\Services;

use Ragab\DTOs\UaeClient;
use Ragab\Exceptions\AccessTokenException;
use Ragab\Exceptions\InvalidStateException;

class AccessToken
{
    public function __construct(protected UaeClient $client){}

    public static function for(UaeClient $client)
    {
        return new self($client);
    }

    public function validateState($state)
    {
        if (! StateToken::verify($state)) throw new InvalidStateException;
        return $this;
    }

    public function get(string $code)
    {
        $headers = [
            'Content-Type: multipart/form-data',
            "Authorization: Basic {$this->client->clientToken()}"
        ];      
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, URLBuilder::build($this->client)->token($code));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $this->client->production() ? true : false);

        $response = curl_exec($ch);

        if ($response === false) throw new AccessTokenException(curl_error($ch));
        else return json_decode($response, true)['access_token'];
    }

}