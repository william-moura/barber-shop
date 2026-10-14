<?php
namespace Src\Barbershop\Domain\Repositories;

use Src\Barbershop\Domain\Entities\Barbershop;
use Src\Shared\Domain\ValueObjects\BarbershopId;

interface BarbershopRepositoryInterface
{
    public function save(Barbershop $barbershop): Barbershop;
    public function findById(BarbershopId $id): ?Barbershop;
    public function findBySlug(string $slug): ?Barbershop;
    public function findByCnpj(string $cnpj): ?Barbershop;
    public function findAll(): array;
}