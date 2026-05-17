<?php

namespace Src\Domain\Customer\Repositories;

use Src\Domain\Customer\Entities\Customer;

interface CustomerRepositoryInterface
{
    public function create(Customer $customer): void;
    public function update(Customer $customer): void;
    public function delete(Customer $customer): void;
    public function findById(int $id): Customer;
    public function findAll(): array;
    public function findByEmail(string $email): Customer;
    public function findByPhone(string $phone): Customer;
    public function findByDocument(string $document): Customer;
}