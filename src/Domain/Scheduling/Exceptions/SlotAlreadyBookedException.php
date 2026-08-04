<?php

namespace Src\Domain\Scheduling\Exceptions;

use Exception;

class SlotAlreadyBookedException extends Exception
{
    public function __construct(string $message = "Este horário já está agendado.")
    {
        parent::__construct($message);
    }
}