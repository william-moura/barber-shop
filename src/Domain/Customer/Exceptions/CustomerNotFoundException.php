<?php

namespace Src\Domain\Customer\Exceptions;

use Exception;

class CustomerNotFoundException extends Exception
{
    public function __construct(string $message = 'Customer not found')
    {
        parent::__construct($message, 404);
    }
}