<?php

namespace Ragab\Services;

use Ragab\DTOs\UaeClient;

class URLBuilder
{
    public function __construct(protected UaeClient $client){}

    public static function build(UaeClient $client) : URLBuilder
    {
        return new self($client);
    }
    public function login()
    {
        $spScope = "urn:uae:digitalid:profile:general urn:uae:digitalid:profile:general:profileType urn:uae:digitalid:profile:general:unifiedId";
        $acr = "urn:safelayer:tws:policies:authentication:level:low";

        return $this->uaePassID() . '/authorize?state=' . StateToken::token() . '&response_type=code&client_id=' . $this->client->clientId() . '&redirect_uri=' . $this->client->redirectURL() . '&scope=' . $spScope . '&acr_values=' . $acr . '&ui_locales=' . $this->client->local();
    }

    public function register()
    {
        $acr = "acr_values=urn:digitalid:authentication:flow:mobile";
        $url = $this->client->production() ? 'https://registration.uaepass.ae' : 'https://stg-registration.uaepass.ae';

        return "{$url}/?{$acr}&client_id={$this->client->clientId()}&redirect_uri={$this->client->redirectURL()}&state={SessionToken::token()}&response_type=code&scope=openid&ui_locales={$this->client->local()}";
    }

    public function token($code)
    {
        return $this->uaePassID() . '/token?grant_type=authorization_code&code=' . $code . '&redirect_uri=' . $this->client->redirectURL();
    }

    public function user()
    {
        return 'https://id.uaepass.ae/idshub/userinfo';
    }
    

    public function logout()
    {
        return $this->uaePassID() . '/logout?redirect_uri=' . $this->client->redirectURL();
    }

    public function uaePassID()
    {
        return $this->client->production() ? 'https://id.uaepass.ae/idshub' : 'https://stg-id.uaepass.ae/idshub';
    }
}