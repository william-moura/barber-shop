<?php
namespace Src\Shared\Domain\ValueObjects;

interface ValueObject
{
    public function getValue(): mixed;
}