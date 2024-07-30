<?php

namespace Ragab\Services;

class StateToken
{
    const state = '@jdA_fW32$2dasW';

    public static function token()
    {
        return password_hash(self::state, PASSWORD_BCRYPT, ['cost' => 12]);
    }

    public static function verify($token)
    {
        return password_verify(self::state, $token);
    }
}