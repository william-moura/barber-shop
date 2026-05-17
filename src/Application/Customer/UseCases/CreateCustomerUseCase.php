<?php

namespace Src\Application\Customer\UseCases;

use InvalidArgumentException;
use Src\Application\Customer\DTOs\CreateCustomerDTO;
use Src\Domain\Customer\Entities\Customer;
use Src\Domain\Customer\Repositories\CustomerRepositoryInterface;
use Src\Domain\Customer\ValuesObjects\Document;

class CreateCustomerUseCase
{
    public function __construct(
        private CustomerRepositoryInterface $customerRepository
    ) {}

    public function execute(CreateCustomerDTO $dto): Customer
    {
        $document = new Document($dto->document);
        if (!$document->isValid()) {
            throw new InvalidArgumentException('Documento inválido');
        }
        $customer = Customer::create(
            name: $dto->name,
            email: $dto->email,
            phone: $dto->phone,
            document: $document->getValue()
        );
        $this->customerRepository->create($customer);
        return $customer;
    }
}