<?php

namespace App\Http\Requests\configuracion;

use Illuminate\Foundation\Http\FormRequest;

class polizasRequest extends FormRequest
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
            'nombre_poliza' => 'required',
            'dano_material' => 'required',
            'robo_total' => 'required',
            'a_poliza' => 'required',

        ];
    }
    public function messages()
    {
        return [
            'nombre_poliza.required' => 'El nombre de la póliza es requerida',
            'dano_material.required' => 'El porcentaje de daño material es requerido',
            'robo_total.required' => 'El porcentaje de robo total es requerido',
            'a_poliza.regex' => 'El archivo es requerido',
        ];
    }
}
