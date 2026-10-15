<?php

namespace App\Barber\Domain\ValueObjects;

use Illuminate\Support\Str;
use Src\Shared\Domain\ValueObjects\ValueObject;

class BarberId implements ValueObject
{
    private string $id;
    public function __construct(?string $id = null)
    {
        // Se não for passado nenhum ID (registro novo), o domínio gera um UUID automaticamente
        if ($id === null) {
            $this->id = (string) Str::uuid();
            return;
        }

        // Validação básica se a string segue o formato padrão de um UUID
        if (!Str::isUuid($id)) {
            throw new \InvalidArgumentException("O ID informado não é um UUID string válido.");
        }

        $this->id = $id;
    }
    public function getValue(): string
    {
        return $this->id;
    }
}