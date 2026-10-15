<?php

namespace App\Barber\Domain\Entities;

use App\Barber\Domain\ValueObjects\BarberId;
use Src\Barbershop\Domain\Entities\Barbershop;
use Src\Shared\Domain\Entities\Entity;
use Src\Shared\Domain\ValueObjects\ValueObject;

class Barber implements Entity
{
    public function __construct(
        public BarberId $id,
        public string $name,
        public string $email,
        public string $phone,
        public Barbershop $barbershop,
    ) {}

    public function getId(): ValueObject
    {
        return $this->id;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'barbershop' => $this->barbershop->toArray(),
        ];
    }

}