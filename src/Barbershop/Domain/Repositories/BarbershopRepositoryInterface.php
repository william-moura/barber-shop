<?php
namespace Src\Barbershop\Domain\Repositories;

use Src\Barbershop\Domain\Entities\Barbershop;
use Src\Shared\Domain\Entities\Entity;
use Src\Shared\Domain\Repositories\RepositoryInterface;
use Src\Shared\Domain\ValueObjects\BarbershopId;
use Src\Shared\Domain\ValueObjects\ValueObject;

interface BarbershopRepositoryInterface
    extends RepositoryInterface
{
    // public function save(Barbershop $barbershop): Barbershop;
    // public function findById(ValueObject $id): ?Entity;
    public function findBySlug(string $slug): ?Barbershop;
    public function findByCnpj(string $cnpj): ?Barbershop;
    // public function findAll(): array;
    // public function update(Barbershop $barbershop): Barbershop;
    // public function delete(Barbershop $barbershop): void;
}