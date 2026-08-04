<?php

namespace Src\Schedule\Application\UseCases;

use Src\Agendamento\Dominio\Entidades\Agendamento;
use Src\Agendamento\Dominio\Repositorios\AgendamentoRepositoryInterface;
use Src\Agendamento\Dominio\Servicos\ValidadorDeConflitoHorario;
use DateTimeImmutable;

class AgendarServico
{
    // Injeção de dependência pelas Interfaces (Desacoplamento total do banco)
    public function __construct(
        private AgendamentoRepositoryInterface $repository,
        private ValidadorDeConflitoHorario $validadorConflito
    ) {}

    public function executar(array $dados): Agendamento
    {
        $dataHora = new DateTimeImmutable($dados['data_hora']);

        // 1. Regra de Negócio Complexa: Verifica se o barbeiro já está ocupado
        $this->validadorConflito->verificar(
            $dados['tenant_id'], 
            $dados['barbeiro_id'], 
            $dataHora
        );

        // 2. Instancia a Entidade de Domínio (Garante as validações internas)
        $agendamento = new Agendamento(
            null,
            $dados['tenant_id'],
            $dados['cliente_id'],
            $dados['barbeiro_id'],
            $dataHora
        );

        // 3. Salva no banco através do repositório (Infraestrutura)
        return $this->repository->salvar($agendamento);
    }
}
