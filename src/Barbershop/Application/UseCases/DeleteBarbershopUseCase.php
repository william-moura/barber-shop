<?php
namespace Src\Barbershop\Application\UseCases;

use Src\Barbershop\Domain\Repositories\BarbershopRepositoryInterface;
use Src\Shared\Domain\ValueObjects\BarbershopId;

class DeleteBarbershopUseCase
{
    public function __construct(private BarbershopRepositoryInterface $repository)
    {
    }
    public function execute(string $id): array
    {
        $barbershop = $this->repository->findById(new BarbershopId($id));
        if (!$barbershop) {
            throw new \DomainException("Barbearia não encontrada");
        }
        $this->repository->delete($barbershop);
        return $barbershop->toArray();
    }
}