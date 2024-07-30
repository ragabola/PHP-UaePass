<?php

namespace Ragab\Exceptions;

use Exception;

class InvalidStateException extends Exception
{
    protected $message = "Invalid State Passed";
}