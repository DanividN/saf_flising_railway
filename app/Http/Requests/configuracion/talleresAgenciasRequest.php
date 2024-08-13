<?php

namespace App\Http\Requests\configuracion;

use Illuminate\Foundation\Http\FormRequest;

class talleresAgenciasRequest extends FormRequest
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
            'tipo' => 'required|max:255',
            'servicios' => 'required|max:255',
            'razon_social' => 'required|max:255',
            'nombre_comercial' => 'required|max:255',
            'telefono_proveedor' => 'required|max:10',
            'rfc_proveedor' => 'required|regex:/^([A-ZÑ&]{3,4})\d{6}([A-Z\d]{3})$/',
            'correo_proveedor' => 'required|email',
            'calle_proveedor' => 'required|max:255',
            'n_exterior' => 'required|max:8',
            'colonia' => 'required|max:255',
            'id_municipio' => 'required|max:255',
            'cp_proveedor' => 'required|max:5',
            'direccion_proveedor' => 'required|max:255'
        ];
    }
    public function messages()
    {
        return [
            'tipo.required' => 'El tipo es requerido',
            'servicios.required' => 'El tipo de servicio es requerido',
            'razon_social.required' => 'La razon social es requerida',
            'nombre_comercial.required' => 'El nombre comercial es requerido',
            'telefono_proveedor.required' => 'El teléfono es requerido, con un máximo de 10 dígitos',
            'rfc_proveedor.regex' => 'El RFC es requerido o no tiene un formato válido (por ejemplo: AAAA123456XXX)',
            'correo_proveedor.email' => 'El correo es requerido o no es válido',
            'calle_proveedor.required' => 'La calle es requerida y debe ser menor a los 250 caracteres',
            'n_exterior.required' => 'El numero exterior es requerido',
            'colonia.required' => 'La colonia es requerida',
            'id_municipio.required' => 'El municipio es requerido',
            'cp_proveedor.required' => 'El Código Postal es requerido',
            'direccion_proveedor.required' => 'La dirección es requerida',
        ];
    }
}
