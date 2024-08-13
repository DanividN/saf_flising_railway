<?php

namespace App\Http\Requests\administracion;

use Illuminate\Foundation\Http\FormRequest;

class tenenciaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'fecha_pago'=>'required|string',
            'monto_tenencia'=> 'required|string',
            'a_evidencia_tenencia'=>'required',
            'observacion'=>'nullable|string'
        ];

        return $rules;
    }
    public function attributes()
    {
        return [
            'fecha_pago'=>'fecha de pago',
            'monto_tenencia'=> 'monto de la tenencia',
            'a_evidencia_tenencia'=>' evidencia',
            'observacion'=>'observaiones'
        ];
    }
}
