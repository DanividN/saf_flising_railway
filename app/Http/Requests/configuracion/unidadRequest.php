<?php

namespace App\Http\Requests\configuracion;

use Illuminate\Foundation\Http\FormRequest;

class unidadRequest extends FormRequest
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
        $clienteId = $this->route('unidade')->id_unidad ?? $this->route('unidade');
        $rules = [
            'id_tipo_unidad'=> 'required|integer|exists:tipo_unidad,id_tipo_unidad',
            'id_marca' => 'required|integer|exists:marca,id_marca',
            'modelo' => 'required|string',
            'year' => 'required|integer|exists:years,id_year',
            'color' => 'required|string',
            'n_serie' => 'required|string|min:20',
            'n_motor' => 'nullable|string|min:11',
            'kilometraje' => 'required|string',
            'vehiculo_id' => 'required|string',
            'fecha_mantenimiento' => 'required|string',
            'costo_mantenimiento' => 'required|string',
            'id_proveedor' => 'required|integer|exists:proveedores,id_proveedor',
            'n_factura' => 'required|string|min:10',
            'codigo_llave' => 'required|string',
            'codigo_locker' => 'required|string',
            'observaciones' => 'nullable|string',
            'mantenimiento_km' => 'required|string',
            'mantenimiento_tiempo'=> 'required|integer|exists:mantenimiento_tiempo,id_mantenimiento_tiempo',
        ];

        // Reglas adicionales para la creación
        if ($this->isMethod('post')) {
            $rules['vehiculo_id'] .= '|unique:unidades,vehiculo_id';
            $rules['a_factura'] = 'nullable';
            $rules['a_garantia_fabrica'] = 'nullable';
            $rules['a_manual_servicio'] = 'nullable';
            $rules['a_garantia_contractual'] = 'nullable';
            $rules['a_garantia_unidad'] = 'nullable';
        }

        // Reglas adicionales para la actualización
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            // Agregar regla única para la actualización, excluyendo el registro actual
            if (isset($rules['vehiculo_id'])) {
                $rules['vehiculo_id'] .= '|unique:unidades,vehiculo_id,' . $clienteId . ',id_unidad';
            }
            $rules['a_factura'] = 'nullable';
            $rules['a_garantia_fabrica'] = 'nullable';
            $rules['a_manual_servicio'] = 'nullable';
            $rules['a_garantia_contractual'] = 'nullable';
            $rules['a_garantia_unidad'] = 'nullable';
        }

        return $rules;
    }
}
