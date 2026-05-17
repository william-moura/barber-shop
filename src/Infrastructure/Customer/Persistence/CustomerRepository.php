<?php

namespace Src\Infrastructure\Customer\Persistence;

use Src\Domain\Customer\Exceptions\CustomerNotFoundException;
use Src\Domain\Customer\Repositories\CustomerRepositoryInterface;
use Src\Domain\Customer\Entities\Customer;
use Src\Infrastructure\Customer\Persistence\Models\Customer as CustomerModel;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function __construct(
        private CustomerModel $model
    ) {}
    public function create(Customer $customer): void
    {
        $this->model->create($customer->toArray());
    }

    public function update(Customer $customer): void
    {
        $this->model->update($customer->toArray());
    }

    public function delete(Customer $customer): void
    {
        $this->model->where('id', $customer->getId())->delete();
    }

    public function findById(int $id): Customer
    {
        $data = $this->model->find($id);
        if (!$data) {
            throw new CustomerNotFoundException('Customer not found');
        }
        return new Customer(
            id: $data->id,
            name: $data->name,
            email: $data->email,
            phone: $data->phone,
            document: $data->document
        );
    }

    public function findAll(): array
    {
        return $this->model->all()->toArray();
    }

    public function findByEmail(string $email): Customer
    {
        $data = $this->model->where('email', $email)->first();
        if (!$data) {
            throw new CustomerNotFoundException('Customer not found');
        }
        return new Customer(
            id: $data->id,
            name: $data->name,
            email: $data->email,
            phone: $data->phone,
            document: $data->document
        );
    }

    public function findByPhone(string $phone): Customer
    {
        $data = $this->model->where('phone', $phone)->first();
        if (!$data) {
            throw new CustomerNotFoundException('Customer not found');
        }
        return new Customer(
            id: $data->id,
            name: $data->name,
            email: $data->email,
            phone: $data->phone,
            document: $data->document
        );
    }

    public function findByDocument(string $document): Customer
    {
        $data = $this->model->where('document', $document)->first();
        if (!$data) {
            throw new CustomerNotFoundException('Customer not found');
        }
        return new Customer(
            id: $data->id,
            name: $data->name,
            email: $data->email,
            phone: $data->phone,
            document: $data->document
        );
    }

}