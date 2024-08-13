<?php

namespace App\Http\Requests\pwa;

use Illuminate\Foundation\Http\FormRequest;

class CrearValidacionRequest extends FormRequest {

    public function messages(): array {
        return [
            'vida_util_llantas.required' => 'La vida útil de las llantas es requerida',
            'observacion_supervisor.required' => 'La observación del supervisor es requerida',
            'obsevaciones_vista_frontal.required' => 'Las observaciones de la vista frontal son requeridas',
            'obsevaciones_vista_izquierda.required' => 'Las observaciones de la vista izquierda son requeridas',
            'obsevaciones_vista_trasera.required' => 'Las observaciones de la vista trasera son requeridas',
            'obsevaciones_vista_derecha.required' => 'Las observaciones de la vista derecha son requeridas',
        ];
    }

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'vida_util_llantas' => 'required',
            'observacion_supervisor' => 'required',
            'obsevaciones_vista_frontal' => 'required',
            'obsevaciones_vista_izquierda' => 'required',
            'obsevaciones_vista_trasera' => 'required',
            'obsevaciones_vista_derecha' => 'required',
        ];
    }
}
