<?php

namespace App\Http\Requests\configuracion;

use Illuminate\Foundation\Http\FormRequest;

class clienteResponsableRequest extends FormRequest
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
        $responsableId =$this->route('responsable')->id_responsable ?? $this->route('responsable');

        $rules = [
            'nombre_responsable' => 'required|string|max:100',
            'cargo' => 'required|string|max:100',
            'telefono_responsable' => 'required|numeric|min:10',
            'numero_empleado' => 'required|numeric',
            'correo_responsable' => 'required|string|email',
            'folio_ine' => 'required|numeric',
            'activo' => 'nullable',
            'vip' => 'nullable',
            'a_ine_responsable' => 'nullable',
        ];

        // Reglas adicionales para la creación
        if ($this->isMethod('post')) {
            $rules['correo_responsable'] .= '|unique:responsables,correo_responsable';
        }

        // Reglas adicionales para la actualización
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            if (isset($rules['correo_responsable'])) {
                $rules['correo_responsable'] .= '|unique:responsables,correo_responsable,'. $responsableId .',id_responsable';
            }
        }

    return $rules;
    }
    public function attributes()
    {
        return [
            'nombre_responsable'=>'nombre responsable',
            'telefono_responsable' => 'telefono responsable',
            'correo_responsable' => 'correo responsable',
            'folio_ine' => 'folio ine',
            'numero_empleado' => 'numero empleado',
            'estatus' => 'estatus',
            'cargo'=>'cargo',
            'vip' =>'VIP'
        ];
    }
}
