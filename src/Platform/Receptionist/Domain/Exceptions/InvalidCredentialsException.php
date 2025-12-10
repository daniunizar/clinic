<?php

namespace Src\Platform\Receptionist\Domain\Exceptions;

use RuntimeException;

class InvalidCredentialsException extends RuntimeException
{
    public function __construct(string $message = 'Invalid email or password')
    {
        parent::__construct($message);
    }
}