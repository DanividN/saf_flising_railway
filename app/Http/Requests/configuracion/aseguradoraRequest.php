<?php

namespace App\Http\Requests\configuracion;

use Illuminate\Foundation\Http\FormRequest;

class aseguradoraRequest extends FormRequest
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
                'razon_aseguradora' => 'required|max:255',
                'nombre_aseguradora' => 'required|max:255',
                'telefono_aseguradora' => 'required|regex:/^\d{3} \d{3} \d{4}$/',
                'rfc_aseguradora' => 'required|regex:/^([A-ZÑ&]{3,4})\d{6}([A-Z\d]{3})$/',
                'correo_aseguradora' => 'required|email',
                'calle_aseguradora' => 'required|max:255',
                'n_exterior_aseguradora' => 'required|max:8',
                'colonia_aseguradora' => 'required|max:255',
                'id_municipio' => 'required',
                'cp_aseguradora' => 'required|regex:/^\d{5}$/',
                'activo' => 'required',
            ];
        }
    public function messages()
    {
        return [
            'razon_aseguradora.required' => 'La razón social es requerida',
            'razon_aseguradora.max' => 'La razón social debe tener menos de 255 caracteres',
            'nombre_aseguradora.required' => 'El nombre comercial es requerido',
            'nombre_aseguradora.max' => 'El nombre comercial debe tener menos de 255 caracteres',
            'telefono_aseguradora.required' => 'El teléfono es requerido',
            'telefono_aseguradora.regex' => 'El formato del teléfono no es válido. Deben ser 10 números sin espacios ni separadores.',
            'rfc_aseguradora.required' => 'El RFC es requerido',
            'rfc_aseguradora.regex' => 'El RFC no tiene un formato válido. Debe tener el formato correcto (por ejemplo: AAAA123456XXX)',
            'correo_aseguradora.required' => 'El correo es requerido',
            'correo_aseguradora.email' => 'El correo no es válido',
            'calle_aseguradora.required' => 'La calle es requerida',
            'calle_aseguradora.max' => 'La calle debe tener menos de 255 caracteres',
            'n_exterior_aseguradora.required' => 'El número exterior es requerido',
            'n_exterior_aseguradora.max' => 'El número exterior debe tener menos de 8 caracteres',
            'colonia_aseguradora.required' => 'La colonia es requerida',
            'colonia_aseguradora.max' => 'La colonia debe tener menos de 255 caracteres',
            'id_municipio.required' => 'El municipio es requerido',
            'cp_aseguradora.required' => 'El Código Postal es requerido',
            'cp_aseguradora.regex' => 'El Código Postal es inválido. Debe ser un número de 5 dígitos.',
        ];
    }
}
