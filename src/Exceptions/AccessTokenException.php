<?php

namespace Ragab\Exceptions;

use Exception;

class AccessTokenException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}