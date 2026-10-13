<?php
namespace Src\Barbershop\Infrastructure\Persistence;

use Src\Barbershop\Domain\Repositories\BarbershopRepositoryInterface;
use Src\Barbershop\Domain\Entities\Barbershop;
use Src\Shared\Domain\ValueObjects\BarbershopId;
use App\Models\Barbershop as BarbershopModel;

class BarbershopRepository implements BarbershopRepositoryInterface
{
    public function save(Barbershop $barbershop): Barbershop
    {
        $data = $barbershop->toArray();
        // dd($data);
        $model = BarbershopModel::updateOrCreate(['id' => $barbershop->getId()->getValue()], $data);
        return $this->toEntity($model);        
    }
    public function findById(BarbershopId $id): ?Barbershop
    {
        return BarbershopModel::find($id);
    }
    public function findBySlug(string $slug): ?Barbershop
    {
        return BarbershopModel::where('slug', $slug)->first();
    }
    public function findByCnpj(string $cnpj): ?Barbershop
    {
        return BarbershopModel::where('cnpj', $cnpj)->first();
    }
    private function toEntity(BarbershopModel $model): Barbershop 
    {
        return new Barbershop(
            id: new BarbershopId($model->id),
            name: $model->name,
            slug: $model->slug,
            cnpj: $model->cnpj,
            phone: $model->phone,
            color: $model->color,
            isActive: (bool) $model->isActive
        );
    }
}