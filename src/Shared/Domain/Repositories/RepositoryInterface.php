<?php
namespace Src\Shared\Domain\Repositories;

use Src\Shared\Domain\Entities\Entity;
use Src\Shared\Domain\ValueObjects\ValueObject;

interface RepositoryInterface
{
    public function save(Entity $entity): Entity;
    public function findById(ValueObject $id): ?Entity;
    public function findAll(): array;
    public function update(Entity $entity): Entity;
    public function delete(Entity $entity): void;
}