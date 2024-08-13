<?php

namespace App\Http\Requests\configuracion;

use Illuminate\Foundation\Http\FormRequest;

class clienteRequest extends FormRequest
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
        $clienteId = $this->route('cliente')->id_cliente ?? $this->route('cliente');
        $rules = [
            'tipo_cliente' => 'nullable|exists:tipo_cliente,id_tipo', // Hacerlo no obligatorio en la actualización
            'nombre_cliente' => 'nullable|string|max:100', // Hacerlo no obligatorio en la actualización
            'rfc' => 'nullable|string|min:13', // Hacerlo no obligatorio en la actualización
            'calle' => 'required|string',
            'n_exterior' => 'required|numeric',
            'n_interior' => 'nullable|string',
            'id_municipio' => 'required|exists:municipios,id_municipio',
            'codigo_postal' => 'required|numeric',
            'nombre_representante' => 'required|string|max:100',
            'correo_representante' => 'required|string|email',
            'telefono_cliente' => 'required|digits:10',
            'direccion_cliente' => 'required|string|max:100',
            'cx' => 'required',
            'cy' => 'required',
        ];

        // Reglas adicionales para la creación
        if ($this->isMethod('post')) {
            $rules['tipo_cliente'] = 'required|exists:tipo_cliente,id_tipo';
            $rules['nombre_cliente'] = 'required|string|max:100';
            $rules['rfc'] = 'required|string|min:13';
            $rules['correo_representante'] .= '|unique:clientes,correo_representante';
            $rules['a_identificacion'] = 'nullable|max:100';
            $rules['a_situacion_fiscal'] = 'nullable|max:100';
            $rules['a_comprobante_domicilio'] = 'nullable|max:100';
        }

        // Reglas adicionales para la actualización
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            if (isset($rules['correo_representante'])) {
                $rules['correo_representante'] .= '|unique:clientes,correo_representante,' . $clienteId . ',id_cliente';
            }
            $rules['a_identificacion'] = 'nullable';
            $rules['a_situacion_fiscal'] = 'nullable';
            $rules['a_comprobante_domicilio'] = 'nullable';
        }

        return $rules;
    }
    public function attributes()
    {
        return [
            'tipo_cliente'=> 'tipo de cliente',
            'nombre_cliente'=>'nombre cliente/Área/Dependencia',
            'rfc'=>'RFC',
            'calle'=>'calle',
            'n_interior'=>'no. Interior',
            'n_exterior'=>'no. Exterior',
            'id_municipio'=>'municipio',
            'codigo_postal'=>'código postal',
            'nombre_representante'=>'titular del área',
            'correo_representante'=>'correo del titular área',
            'telefono_cliente'=>'telefono celular u oficina',
            'a_identificacion'=>'INE',
            'a_situacion_fiscal'=>'comprobante de situación fiscal',
            'a_comprobante_domicilio'=>'comprobante de domicilio',
            'direccion_cliente'=>'direccion',
        ];
    }
}
