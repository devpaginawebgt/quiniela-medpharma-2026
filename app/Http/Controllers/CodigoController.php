<?php

namespace App\Http\Controllers;

use App\Http\Requests\Codigo\CodigoRequest;
use App\Http\Services\CodigoService;
use App\Traits\ApiResponse;

class CodigoController extends Controller
{
    public function __construct(
        private readonly CodigoService $codigoService,
    ) {}

    use ApiResponse;

    public function isValid(CodigoRequest $request) {
        $result = $this->codigoService->validate(
            $request->validated('code'),
            $request->validated('country_id')
        );

        if (!$result['success']) {
            return $this->errorResponse($result['message'], $result['code']);
        }

        return $this->successResponse(['message' => 'Código de invitación válido.']);
    }
}
