<?php
namespace Src\Shared\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Model;
use Src\Shared\Domain\Entities\Entity;
use Src\Shared\Domain\Repositories\RepositoryInterface;
use Src\Shared\Domain\ValueObjects\ValueObject;

abstract class Repository implements RepositoryInterface
{
    protected $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function save(Entity $entity): Entity
    {
        return $entity;
    }
    public function findById(ValueObject $id): ?Entity
    {
        $model = $this->model->find($id->getValue());
        return $model ? $this->toEntity($model) : null;
    }
    public function findAll(): array
    {
        $models = $this->model->all();
        return $models->map(function(Model $model) {
            return $this->toEntity($model)->toArray();
        })->toArray();
    }
    public function update(Entity $entity): Entity
    {
        $model = $this->model->find($entity->getId()->getValue());
        if (!$model) {
            throw new \DomainException("Entity not found");
        }
        $model->update($entity->toArray());
        return $this->toEntity($model);
    }
    public function delete(Entity $entity): void
    {
        $model = $this->model->find($entity->getId()->getValue());
        if (!$model) {
            throw new \DomainException("Entity not found");
        }
        $model->delete();
    }
    abstract protected function toEntity(Model $model): Entity;
}