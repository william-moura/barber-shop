<?php
namespace Src\Barbershop\Application\UseCases;

use Src\Barbershop\Application\DTOs\BarbershopInputData;
use Src\Barbershop\Domain\Entities\Barbershop;
use Src\Barbershop\Domain\Repositories\BarbershopRepositoryInterface;
use Illuminate\Support\Str;
use Exception;
use Src\Shared\Domain\ValueObjects\BarbershopId;

class CreateBarbershopUseCase
{
    public function __construct(private BarbershopRepositoryInterface $repository)
    {
    }
    public function execute(BarbershopInputData $input): Barbershop
    {
        // 1. Regra de Negócio: Tratar e validar o slug da barbearia
        $slugTratado = Str::slug($input->slug);
        if ($this->repository->findBySlug($slugTratado)) {
            throw new Exception("Este endereço web (slug) já está sendo utilizado por outra barbearia.");
        }
        // 2. Regra de Negócio: Verificar se o CNPJ já está em uso
        if ($input->cnpj && $this->repository->findByCnpj($input->cnpj)) {
            throw new Exception("Este CNPJ já está sendo utilizado por outra barbearia.");
        }        
        // 4. Criar a barbearia
        $barbershop = new Barbershop(
            new BarbershopId(null),
            $input->name,
            $slugTratado,
            $input->cnpj,
            $input->phone,
            $input->color,
        );
        return $this->repository->save($barbershop);
    }
}