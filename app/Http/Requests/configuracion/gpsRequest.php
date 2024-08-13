<?php

namespace App\Http\Requests\configuracion;

use Illuminate\Foundation\Http\FormRequest;

class gpsRequest extends FormRequest
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
            'razon_gps' => 'required|max:255',
            'nombre_gps' => 'required|max:255',
            'telefono_gps' => 'required|regex:/^\d{3} \d{3} \d{4}$/',
            'rfc_gps' => 'required|regex:/^([A-ZÑ&]{3,4})\d{6}([A-Z\d]{3})$/',
            'correo_gps' => 'required|email',
            'calle_gps' => 'required|max:255',
            'n_exterior_gps' => 'required|max:8',
            'colonia_gps' => 'required|max:255',
            'id_municipio' => 'required',
            'cp_gps' => 'required|regex:/^\d{5}$/',
            'activo' => 'required',

        ];
    }
    public function messages()
    {
        return [
            'razon_gps.required' => 'La razón social es requerida',
            'nombre_gps.required' => 'El nombre comercial es requerido',
            'telefono_gps.required' => 'El teléfono es requerido',
            'telefono_gps.regex' => 'El formato del teléfono no es válido. Deben ser 10 numeros',
            'rfc_gps.required' => 'El RFC es requerido',
            'rfc_gps.regex' => 'El RFC no tiene un formato válido. Debe tener el formato correcto (por ejemplo: AAAA123456XXX)',
            'rfc_gps.required' => 'El correo es requerido',
            'rfc_gps.email' => 'El correo no es válido',
            'calle_gps.required' => 'La calle es requerida',
            'calle_gps.max' => 'La calle debe ser menor a los 250 caracteres',
            'n_exterior_gps.required' => 'El numero es requerido',
            'colonia_gps.required' => 'La Colonia es requerida',
            'colonia_gps.max' => 'La Colonia debe ser menos a 250 caracteres',
            'id_municipio.required' => 'El municipio es requerido',
            'cp_gps.required' => 'El Código Postal es requerido',
            'cp_gps.regex' => 'El Código Postal es invalido',

        ];
    }
}
