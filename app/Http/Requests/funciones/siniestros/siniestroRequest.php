<?php

namespace App\Http\Requests\funciones\siniestros;

use Illuminate\Foundation\Http\FormRequest;

class siniestroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $rules = [];

            // Reglas adicionales para la creación
            if ($this->isMethod('post')) {
                $rules['id_cliente'] = 'required|exists:clientes,id_cliente';
                $rules['id_unidad'] ='required|exists:unidades,id_unidad';
            }

            // Reglas adicionales para la actualización
            if ($this->isMethod('put') || $this->isMethod('patch')) {
                $rules['id_siniestro'] = 'required|exists:siniestros,id_siniestro';
                $rules['fecha_siniestro'] = 'required';
                $rules['a_evidencia_siniestro'] = 'required';
                $rules['observaciones'] = 'nullable';
            }
        return $rules;
    }
    public function attributes()
    {
        return [
            'id_cliente' => 'cliente',
            'id_unidad' => 'unidad',
            'id_siniestro' => 'siniestro',
            'id_poliza_seguro' => 'poliza de seguro',
            'fecha_siniestro' => 'fecha del siniestro',
            'a_evidencia_siniestro' => 'evidencia del siniestro',
            'observaciones' => 'observación',
        ];
    }
}
