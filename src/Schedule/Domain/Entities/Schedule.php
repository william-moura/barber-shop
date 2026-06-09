<?php

namespace Src\Schedule\Domain\Entities;

use DateTimeImmutable;
use Exception;

class Schedule
{
    public function __construct(
        private ?string $id,
        private string $tenantId,
        private string $clienteId,
        private string $barbeiroId,
        private DateTimeImmutable $dataHora,
        private string $status = 'pendente'
    ) {
        // Regra de Domínio: Não permite agendar no passado
        if ($this->dataHora < new DateTimeImmutable()) {
            throw new Exception("Não é possível realizar um agendamento para uma data passada.");
        }
    }

    public function cancelar(): void
    {
        // Regra de Domínio: Validar antecedência mínima se necessário
        $this->status = 'cancelado';
    }

    // Getters para expor as propriedades com segurança
    public function getId(): ?string { return $this->id; }
    public function getTenantId(): string { return $this->tenantId; }
    public function getBarbeiroId(): string { return $this->barbeiroId; }
    public function getDataHora(): DateTimeImmutable { return $this->dataHora; }
    public function getStatus(): string { return $this->status; }
}
