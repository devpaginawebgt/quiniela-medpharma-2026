<?php

namespace App\Http\Requests\Codigo;

use Illuminate\Foundation\Http\FormRequest;

class CodigoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code'     => ['required', 'string', 'size:8'],
            'country_id' => ['required', 'integer', 'exists:countries,id'],
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function messages(): array
    {
        return [
            // COUNTRY
            'pais_id.required' => 'Por favor seleccione su país.',
            'pais_id.integer'  => 'El país seleccionado no es válido.',
            'pais_id.exists'   => 'El país seleccionado no existe en nuestros registros.',

            // CODE
            'code.required' => 'Por favor, ingrese su código de invitación.',
            'code.string'   => 'El código de invitación debe ser un texto válido.',
            'code.size'     => 'El código de invitación debe tener exactamente 8 caracteres.',
        ];
    }
}
