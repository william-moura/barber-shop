<?php

namespace Src\Application\Customer\Presentation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\Application\Customer\DTOs\CreateCustomerDTO;
use Src\Application\Customer\UseCases\CreateCustomerUseCase;

class CustomerController extends Controller
{
    public function __construct(
        private CreateCustomerUseCase $createCustomerUseCase
    ) {}

    public function store(Request $request)
    {
        $dto = CreateCustomerDTO::fromRequest($request);
        $customer = $this->createCustomerUseCase->execute($dto);
        return response()->json($customer, 201);
    }
}