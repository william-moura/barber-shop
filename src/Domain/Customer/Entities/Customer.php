<?php

namespace Src\Domain\Customer\Entities;

class Customer
{
    public function __construct(
        public ?int $id = null,
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

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'document' => $this->document,
        ];
    }

    public static function create(
        string $name, 
        string $email, 
        string $phone, 
        string $document
    ): self {
        return new self(
            null,
            name: $name,
            email: $email,
            phone: $phone,
            document: $document
        );
    }

    public function update(
        ?string $name = null, 
        ?string $email = null, 
        ?string $phone = null, 
        ?string $document = null
    ): void {
        if ($name !== null) {
            $this->name = $name;
        }
        if ($email !== null) {
            $this->email = $email;
        }
        if ($phone !== null) {
            $this->phone = $phone;
        }
        if ($document !== null) {
            $this->document = $document;
        }
    }
}