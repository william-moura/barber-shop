<?php
namespace Src\Barbershop\Application\UseCases;

use Src\Barbershop\Domain\Repositories\BarbershopRepositoryInterface;
use Src\Shared\Domain\ValueObjects\BarbershopId;
use DomainException;

class ShowBarbershopUseCase
{
    public function __construct(private BarbershopRepositoryInterface $repository)
    {
    }
    public function execute(string $id): array
    {
        $barbershop = $this->repository->findById(new BarbershopId($id));
        if (!$barbershop) {
            throw new DomainException("Barbearia não encontrada");
        }
        return $barbershop->toArray();
    }
}