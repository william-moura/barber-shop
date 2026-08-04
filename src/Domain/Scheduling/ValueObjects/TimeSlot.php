<?php

namespace Src\Domain\Scheduling\ValueObjects;

use InvalidArgumentException;
use Carbon\Carbon;

class TimeSlot
{
    public function __construct(
        public readonly Carbon $startTime,
        public readonly Carbon $endTime
    ) {
        if ($this->startTime->gte($this->endTime)) {
            throw new InvalidArgumentException('O horário de início deve ser menor que o horário de término.');
        }
    }

    public function getDurationInMinutes(): int
    {
        return $this->startTime->diffInMinutes($this->endTime);
    }
}
