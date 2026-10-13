<?php
namespace Src\Barbershop\Application\DTOs;

class BarbershopInputData
{
    public function __construct(
        public string $name,
        public string $slug,
        public ?string $cnpj,
        public string $phone,
        public string $color,
    ) {}
}