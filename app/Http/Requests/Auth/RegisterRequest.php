<?php

namespace App\Http\Requests\Auth;

use App\Models\Country;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            'nombres'          => ['required', 'string', 'min:2', 'max:60'],
            'apellidos'        => ['required', 'string', 'min:2', 'max:60'],
            'numero_documento' => ['required', 'string', 'min:6', 'max:20', 'unique:users,numero_documento'],
            'telefono'         => ['required', 'integer', 'digits:8'],
            'email'            => ['required', 'email', 'min:5', 'max:255', 'unique:users'],
            'codigo'           => ['required', 'string', 'size:8'],
            'pais_id'          => ['required', 'integer', 'exists:countries,id'],
            'password'         => ['required', 'confirmed', Password::defaults()],
            'accepted_terms'   => ['required', 'accepted'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->has('pais_id') || $validator->errors()->has('numero_documento')) {
                return;
            }

            $country = Country::find($this->pais_id);

            if ($country && $country->document_regex && !preg_match("/{$country->document_regex}/", $this->numero_documento)) {
                $validator->errors()->add(
                    'numero_documento',
                    $country->document_regex_message ?? 'El formato del documento no es válido.'
                );
            }
        });
    }

    public function messages(): array
    {
        return [
            // NOMBRES
            'nombres.required' => 'Por favor, ingrese su nombre.',
            'nombres.string'   => 'El campo nombre debe contener texto.',
            'nombres.min'      => 'El campo nombre debe contener al menos 2 caracteres.',
            'nombres.max'      => 'El campo nombre no debe superar los 60 caracteres.',

            // APELLIDOS
            'apellidos.required' => 'Por favor, ingrese su apellido.',
            'apellidos.string'   => 'El campo apellido debe contener texto.',
            'apellidos.min'      => 'El campo apellido debe contener al menos 2 caracteres.',
            'apellidos.max'      => 'El campo apellido no debe superar los 60 caracteres.',

            // NUMERO DOCUMENTO
            'numero_documento.required' => 'Por favor, ingrese su número de documento.',
            'numero_documento.string'   => 'El número de documento debe ser un texto válido.',
            'numero_documento.min'      => 'El número de documento debe tener al menos 6 caracteres.',
            'numero_documento.max'      => 'El número de documento no puede tener más de 20 caracteres.',
            'numero_documento.unique'   => 'Ya existe un usuario registrado con este número de documento.',

            // TELEFONO
            'telefono.required' => 'Por favor, ingrese su número de teléfono.',
            'telefono.integer'  => 'El campo teléfono debe ser un número válido.',
            'telefono.digits'   => 'El campo teléfono debe tener 8 dígitos.',

            // EMAIL
            'email.required' => 'Por favor, ingrese su correo electrónico.',
            'email.email'    => 'Por favor ingrese un correo electrónico válido.',
            'email.min'      => 'El correo electrónico debe contener al menos 5 caracteres.',
            'email.max'      => 'El correo electrónico no debe superar los 255 caracteres.',
            'email.unique'   => 'Ya existe un usuario registrado con este correo electrónico.',

            // CODIGO
            'codigo.required' => 'Por favor, ingrese su código de invitación.',
            'codigo.string'   => 'El código de invitación debe ser un texto válido.',
            'codigo.size'     => 'El código de invitación debe tener exactamente 8 caracteres.',

            // PAIS
            'pais_id.required' => 'Por favor seleccione su país.',
            'pais_id.integer'  => 'El país seleccionado no es válido.',
            'pais_id.exists'   => 'El país seleccionado no existe en nuestros registros.',

            // PASSWORD
            'password.required'  => 'Por favor, ingrese una contraseña.',
            'password.confirmed' => 'Las contraseñas no coinciden.',

            // ACCEPTED TERMS
            'accepted_terms.required' => 'Debe aceptar los términos y condiciones.',
            'accepted_terms.accepted' => 'Debe aceptar los términos y condiciones para registrarse.',
        ];
    }
}
