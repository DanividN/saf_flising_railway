<?php

namespace App\Http\Requests\funciones\verificacion;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class verificacionRequest extends FormRequest
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
            'id_municipio' => 'required',
            'id_verificentro' => 'required',
            'fecha' => 'required|date',
            'hora' => ['required','regex:/^([0-1]\d|2[0-3]):[0-5]\d$/'],
            'a_cita' => 'required|mimes:pdf',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'fecha' => Carbon::createFromFormat('d/m/Y', $this->fecha)->format('Y-m-d'),
        ]);
    }

    protected function passedValidation()
    {
        $this->merge([
            'fecha_hora_verificacion' => $this->fecha . ' ' . $this->hora . ':00',
        ]);
    }
}
