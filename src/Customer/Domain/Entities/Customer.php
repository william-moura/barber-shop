<?php

namespace Src\Customer\Domain\Entities;

class Customer
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public string $phone,
        public string $document
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getDocument(): string
    {
        return $this->document;
    }
}