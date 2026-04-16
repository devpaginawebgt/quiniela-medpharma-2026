<?php

namespace App\Http\Controllers;

use App\Http\Requests\Codigo\CodigoRequest;
use App\Models\Codigo;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CodigoController extends Controller
{
    use ApiResponse;

    public function isValid(CodigoRequest $request) {
        $code = $request->validated('code');
        $country_id = $request->validated('country_id');

        $db_code = Codigo::where('codigo', $code)->first();

        if (empty($db_code)) {
            return $this->errorResponse('Este código de invitación no existe.', 404);
        }

        if ((int)$db_code->country_id !== (int)$country_id) {
            return $this->errorResponse('Este código de invitación no pertenece a este país.', 406);
        }
        
        if ((int)$db_code->estado === 1) {
            return $this->errorResponse('Este código de invitación ya ha sido utilizado.', 406);
        }

        return $this->successResponse(['message' => 'Código de invitación válido.']);
    }
}
