<?php
namespace Src\Barbershop\Application\UseCases;

use Src\Barbershop\Domain\Repositories\BarbershopRepositoryInterface;

class ListBarbershopUseCase
{
    public function __construct(private BarbershopRepositoryInterface $repository)
    {
    }
    public function execute(): array
    {
        $barbershops = $this->repository->findAll();
        return $barbershops;
    }
}