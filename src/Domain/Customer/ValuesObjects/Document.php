<?php

namespace Src\Domain\Customer\ValuesObjects;

use InvalidArgumentException;

class Document
{
    private const INVALID_DOCUMENT_MESSAGE = 'Documento inválido. Deve ser um CPF ou CNPJ válido.';
    private const INVALID_CPF_MESSAGE = 'CPF inválido.';
    public function __construct(
        private string $value
    ) {
        $this->value = preg_replace('/[^0-9]/', '', $value);
        $this->validateDocument($this->value);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function isValid(): bool
    {
        return preg_match('/^[0-9]{11}$/', $this->value);
    }

    private function validateDocument(string $document): void
    {
        $document = preg_replace('/[^0-9]/', '', $document);
        if (strlen($document) !== 11 || preg_match('/(\d)\1{10}/', $document)) {
            throw new InvalidArgumentException(self::INVALID_CPF_MESSAGE);
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $document[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($document[$c] != $d) {
                throw new InvalidArgumentException(self::INVALID_CPF_MESSAGE);
            }
        }
    }
}