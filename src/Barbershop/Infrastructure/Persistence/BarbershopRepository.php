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
        $model = BarbershopModel::updateOrCreate(['id' => $barbershop->getId()->getValue()], $data);
        return $this->toEntity($model);        
    }
    public function findById(BarbershopId $id): ?Barbershop
    {
        $model = BarbershopModel::find($id);
        return $model ? $this->toEntity($model) : null;
    }
    public function findBySlug(string $slug): ?Barbershop
    {
        $model = BarbershopModel::where('slug', $slug)->first();
        return $model ? $this->toEntity($model) : null;
    }
    public function findByCnpj(string $cnpj): ?Barbershop
    {
        $model = BarbershopModel::where('cnpj', $cnpj)->first();
        return $model ? $this->toEntity($model) : null;
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
    public function findAll(): array
    {
        $models = BarbershopModel::all();        
        return $models->map(function(BarbershopModel $model) {
            return $this->toEntity($model)->toArray();
        })->toArray();
    }
}