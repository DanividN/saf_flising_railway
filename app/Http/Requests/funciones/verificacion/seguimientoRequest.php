<?php

namespace App\Http\Requests\funciones\verificacion;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class seguimientoRequest extends FormRequest
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
            'id_holograma'=>'required_unless:estado,"CANCELADO"',
            'periodo'=>'required_unless:estado,"CANCELADO"',
            'fecha_verificacion'=>'required_unless:estado,"CANCELADO"',
            'year_verificacion'=>'required_unless:estado,"CANCELADO"',
            'monto_verificacion'=>'required_unless:estado,"CANCELADO"',
            'a_evidencia_verificacion'=>'nullable|mimes:pdf',
            'multa_verificacion'=>'required_unless:estado,"CANCELADO"',
            'monto_multa'=>'required_if:multa_verificacion,1',
            'a_comprobante_multa'=>'nullable|mimes:pdf',
            'estado'=>'nullable'
        ];
    }


    protected function passedValidation()
    {
        $this->merge([
            'fecha_verificacion' => Arr::join(array_reverse(explode('/',$this->fecha_verificacion)), '-') ,
            'monto_multa' => Str::replace(',', '',$this->monto_multa??'0'),
            'monto_verificacion' => Str::replace(',', '',$this->monto_verificacion),
        ]);
    }

}
