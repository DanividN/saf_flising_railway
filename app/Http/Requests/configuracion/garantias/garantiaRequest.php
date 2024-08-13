<?php

namespace App\Http\Requests\configuracion\garantias;

use Illuminate\Foundation\Http\FormRequest;

class garantiaRequest extends FormRequest
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
            'razon_social' => 'required|regex:/^[\p{L}0-9\s.,ñÑ]+$/u',
            "nombre_comercial" => 'required|regex:/^[\p{L}0-9\s.,ñÑ]+$/u',
           'telefono_g_flising' => 'required|regex:/^\+?\d{10,15}$/',
            "rfc_g_flising" => 'required|regex:/^([A-ZÑ&]{3,4})\d{6}([A-Z\d]{3})$/',
            "correo_g_flising" => 'required|email|unique:garantias_flising,correo_g_flising',
            "calle_g_flising" => 'required|regex:/^[\p{L}0-9\s.,ñÑ]+$/u',
            "n_exterior_g_flising" => 'required|max:6',
            "colonia_g_flising" => 'required|max:250|regex:/^[\pL\s]+$/u',
            "id_municipio" => "required",
            "cp_g_flising" => 'required|regex:/^\d{5}$/',
            'nombre_contacto.0' => 'required|regex:/^[\pL\s]+$/u',
            'numero_contacto.0' => 'required|regex:/^\+?\d{10,15}$/',
            'correo_contacto.0' => 'required|email',
            'nombre_contacto.1' => 'nullable|regex:/^[\pL\s]+$/u',
            'numero_contacto.1' => 'nullable|regex:/^\+?\d{10,15}$/',
            'correo_contacto.1' => 'nullable|email',
            'nombre_contacto.2' => 'nullable|regex:/^[\pL\s]+$/u',
            'numero_contacto.2' => 'nullable|regex:/^\+?\d{10,15}$/',
            'correo_contacto.2' => 'nullable|email',
         
        ];
    }
    public function messages()
    {
        return [
            'razon_social.regex' => 'La razon social es invalida',
            'nombre_comercial.regex' => 'El nombre comercial es invalido',
            'telefono_g_flising.required' => 'El teléfono es obligatorio',
            'telefono_g_flising.regex' => 'El formato del teléfono no es válido. Deben ser 10 numeros',
            'telefono_g_flising.max' => 'El maximo de caracteres deben ser 10 numeros',
            'rfc_g_flising.required' => 'El RFC es requerido',
            'rfc_g_flising.regex' => 'El RFC no tiene un formato válido. Debe tener el formato correcto (por ejemplo: AAAA123456XXX)',
            'correo_g_flising.required' => 'El correo es requerido',
            'correo_g_flising.email' => 'El correo no es válido',
            'correo_g_flising.unique' => 'El correo ya exite',
            'calle_g_flising.required' => 'La calle es requerida',
            'calle_g_flising.max' => 'La calle debe ser menor a los 250 caracteres',
            'calle_g_flising.regex' => 'La calle no debe contener numeros',
            'n_exterior_g_flising.required' => 'El numero es requerido',
            'n_exterior_g_flising.max' => 'El numero debe ser menor a 6 caracteres',
            'colonia_g_flising.required' => 'La Colonia es requerida',
            'colonia_g_flising.max' => 'La Colonia debe ser menos a 250 caracteres',
            'colonia_g_flising.regex' => 'La Colonia no cumple con los caracteres',
            'id_municipio.required' => 'El municipio es requerido',
            'cp_g_flising.required' => 'El Codigo Postal es requerido',
            'cp_g_flising.regex' => 'El Codigo Postal es invalido',
            
            'nombre_contacto.0.required' => 'El nombre de contacto es requerido',
            'nombre_contacto.0.regex' => 'El nombre de contacto debe contener solo letras y espacios',
            'numero_contacto.0.required' => 'El número de contacto es requerido',
            'numero_contacto.0.regex' => 'El número de contacto no debe contener espacios',
            'correo_contacto.0.required' => 'El correo de contacto es requerido',
            'correo_contacto.0.email' => 'El correo de contacto no es válido',
            'correo_contacto.0.unique' => 'El correo de contacto ya existe',
          
            'nombre_contacto.1.regex' => 'El nombre de contacto debe contener solo letras y espacios',
            'numero_contacto.1.regex' => 'El numero de contacto debe contener solo numeros',
            'correo_contacto.1.email' => 'El correo de contacto no es válido',
            'nombre_contacto.2.regex' => 'El nombre de contacto debe contener solo letras y espacios',
            'numero_contacto.2.regex' => 'El numero de contacto debe contener solo numeros',
            'correo_contacto.2.email' => 'El correo de contacto no es válido',
        ];
    }
}
