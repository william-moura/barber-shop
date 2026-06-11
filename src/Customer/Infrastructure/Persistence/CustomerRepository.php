<?php

namespace Src\Customer\Infrastructure\Persistence;

use Src\Customer\Domain\Repositories\CustomerRepositoryInterface;
use Src\Customer\Infrastructure\Persistence\Models\Customer;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function __construct(
        private Customer $model
    ) {}
    public function create(\Src\Customer\Domain\Entities\Customer $customer): void
    {
        $this->model->create($customer->toArray());
    }
    public function update(\Src\Customer\Domain\Entities\Customer $customer): void
    {
        $this->model->update($customer->toArray());
    }
    public function delete(\Src\Customer\Domain\Entities\Customer $customer): void
    {
        $this->model->delete($customer->getId());
    }
    public function findById(int $id): \Src\Customer\Domain\Entities\Customer
    {
        return $this->model->find($id);
    }
    public function findAll(): array
    {
        return $this->model->all();
    }
    public function findByEmail(string $email): \Src\Customer\Domain\Entities\Customer
    {
        return $this->model->where('email', $email)->first();
    }
    public function findByPhone(string $phone): \Src\Customer\Domain\Entities\Customer
    {
        return $this->model->where('phone', $phone)->first();
    }
    public function findByDocument(string $document): \Src\Customer\Domain\Entities\Customer
    {
        return $this->model->where('document', $document)->first();
    }
}