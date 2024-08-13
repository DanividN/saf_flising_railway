<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{
    public function messages(){
        return[
            'name.required' => 'El campo nombre es requerido',
            'tipo_usuario.required' => 'El campo tipo de usuario es requerido',
            'email.required' => 'El campo email es requerido',
            'email.email' => 'El campo email debe ser un correo electrónico',
            'email.unique' => 'El campo email ya se encuentra registrado',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'name' => 'required',
                    'tipo_usuario' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'turno' => 'required_if:tipo_usuario,CALL_CENTER',
                ];
            }
            case 'PATCH':
            {
                return [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email,' . $this->route('usuario')->id,
                ]; 
            }
            default: {
                return [];
            }
        }
    }
}
