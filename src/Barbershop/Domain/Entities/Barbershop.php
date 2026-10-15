<?php
namespace Src\Barbershop\Domain\Entities;

use InvalidArgumentException;
use Src\Shared\Domain\Entities\Entity;
use Src\Shared\Domain\ValueObjects\BarbershopId;
use Src\Shared\Domain\ValueObjects\ValueObject;

class Barbershop implements Entity
{
    public function __construct(
        private BarbershopId $id,
        private string $name,
        private string $slug,
        private ?string $cnpj,
        private string $phone,
        private string $color,
        private bool $isActive = true,
    ) {
        if (empty($this->name)) {
            throw new InvalidArgumentException('Name is required');
        }
    }

    public function getId(): ValueObject
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getSlug(): string
    {
        return $this->slug;
    }
    public function getCnpj(): ?string
    {
        return $this->cnpj;
    }
    public function getPhone(): string
    {
        return $this->phone;
    }
    public function getColor(): string
    {
        return $this->color;
    }
    public function isActive(): bool
    {
        return $this->isActive;
    }
    public function toArray(): array
    {
        return [
            'id' => $this->id->getValue(),
            'name' => $this->name,
            'slug' => $this->slug,
            'cnpj' => $this->cnpj,
            'phone' => $this->phone,
            'color' => $this->color,
            'isActive' => $this->isActive,
        ];
    }
}