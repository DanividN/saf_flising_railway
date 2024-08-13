<?php

namespace App\Http\Requests\configuracion\garantias;

use Illuminate\Foundation\Http\FormRequest;

class garantiaSeguimientoRequest extends FormRequest
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
           'nombre_g_extendida' => 'nullable|regex:/^[\pL\d,\s]+$/u',
            "vigencia_g_extendida" => 'required',
            'monto_g_extendida' => ['nullable', 'regex:/^\d{1,3}(,\d{3})*(\.\d+)?$/'],
            "descripcion_g_extendida" => 'nullable',
        ];
    }

    public function messages(){
        return [
            'nombre_g_extendida.regex' => 'El nombre de la garantía es invalido',
            'monto_g_extendida.regex' => 'El monto es invalido',
            'a_evidencia_extendida.mimes' => 'El archivo de la evidencia debe ser un pdf',
        ];  
    }
}
