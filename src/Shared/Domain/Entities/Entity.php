<?php
namespace Src\Shared\Domain\Entities;

use Src\Shared\Domain\ValueObjects\ValueObject;

interface Entity
{
    public function toArray(): array;
    public function getId(): ValueObject;
}