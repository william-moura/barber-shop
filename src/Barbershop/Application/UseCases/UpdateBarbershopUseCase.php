<?php
namespace Src\Barbershop\Application\UseCases;

use Src\Barbershop\Domain\Entities\Barbershop;
use Src\Barbershop\Domain\Repositories\BarbershopRepositoryInterface;
use Src\Shared\Domain\ValueObjects\BarbershopId;

class UpdateBarbershopUseCase
{
    public function __construct(private BarbershopRepositoryInterface $repository)
    {
    }
    public function execute(string $id, array $data): array
    {
        $barbershop = $this->repository->findById(new BarbershopId($id));
        if (!$barbershop) {
            throw new \DomainException("Barbearia não encontrada");
        }
        $barbershopUpdate = new Barbershop(
            new BarbershopId($id),
            $data['name'],
            $data['slug'],
            $data['cnpj'],
            $data['phone'],
            $data['color'],
        );
        $barbershop = $this->repository->update($barbershopUpdate);
        return $barbershop->toArray();
    }
}