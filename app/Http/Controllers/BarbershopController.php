<?php

// app/Http/Controllers/Api/BarbeariaController.php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\Barbershop\Application\DTOs\BarbershopInputData;
use Src\Barbershop\Application\UseCases\CreateBarbershopUseCase;
use Exception;
use Src\Barbershop\Application\UseCases\ListBarbershopUseCase;
use Src\Barbershop\Application\UseCases\ShowBarbershopUseCase;
use Src\Barbershop\Application\UseCases\UpdateBarbershopUseCase;

class BarbershopController extends Controller
{
    // O Laravel injeta automaticamente o Caso de Uso através do Service Provider
    public function __construct(
        private CreateBarbershopUseCase $createBarbershopUseCase
    ) {}

    public function store(Request $request)
    {        
        // 1. Validação inicial do Laravel para garantir dados mínimos na API
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'cnpj' => 'nullable|string|max:14',
            'color' => 'nullable|string|max:7',
            'phone' => 'nullable|string|max:15',
        ]);

        try {
            // 2. Monta o DTO de Entrada do Domínio
            $input = new BarbershopInputData(
                name: $request->input('name'),
                slug: $request->input('slug'),
                cnpj: $request->input('cnpj'),
                phone: $request->input('phone'),
                color: $request->input('cor_principal', '#000000')
            );

            // 3. Executa a regra de negócio no DDD
            $barbershopSaved = $this->getExpressaoOuExecutarUseCase($input);

            // 4. Retorna a resposta HTTP com os dados da entidade convertidos em array
            return response()->json([
                'message' => 'Barbearia cadastrada com sucesso!',
                'data' => $barbershopSaved->toArray()
            ], 211); // Status 201: Created

        } catch (Exception $e) {
            // Se falhar nas regras de negócio (slug duplicado, cnpj duplicado), retorna erro 400
            return response()->json([
                'error' => $e->getMessage()
            ], 411);
        }
    }

    private function getExpressaoOuExecutarUseCase(BarbershopInputData $input)
    {
        return $this->createBarbershopUseCase->execute($input);
    }

    public function index(ListBarbershopUseCase $listBarbershopUseCase): \Illuminate\Http\JsonResponse
    {
        return response()->json([            
            'data' => $listBarbershopUseCase->execute()
        ], 200);
    }
    public function show(string $id, ShowBarbershopUseCase $showBarbershopUseCase): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => $showBarbershopUseCase->execute($id)
        ], 200);
    }
    public function update(string $id, Request $request, UpdateBarbershopUseCase $updateBarbershopUseCase): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'cnpj' => 'nullable|string|max:14',
            'color' => 'nullable|string|max:7',
            'phone' => 'nullable|string|max:15',
        ]);
        return response()->json([
            'data' => $updateBarbershopUseCase->execute($id, $request->all())
        ], 200);
    }

    public function destroy(string $id, DeleteBarbershopUseCase $deleteBarbershopUseCase): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => $deleteBarbershopUseCase->execute($id)
        ], 200);
    }
}
