<?php
namespace Src\Barbershop\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;
use Src\Barbershop\Domain\Repositories\BarbershopRepositoryInterface;
use Src\Barbershop\Domain\Entities\Barbershop;
use Src\Shared\Domain\Entities\Entity;
use Src\Shared\Domain\ValueObjects\BarbershopId;
use App\Models\Barbershop as BarbershopModel;
use Src\Shared\Infrastructure\Persistence\Repository;

class BarbershopRepository extends Repository implements BarbershopRepositoryInterface
{
    public function __construct(BarbershopModel $model)
    {
        parent::__construct($model);
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
    protected function toEntity(Model $model): Entity
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