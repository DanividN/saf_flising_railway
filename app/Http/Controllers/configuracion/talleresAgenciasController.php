<?php

namespace App\Http\Controllers\configuracion;

use App\Http\Controllers\Controller;
use App\Models\configuracion\agenciasTalleres;
use App\Models\configuracion\garantiasProveedores;
use App\Http\Requests\configuracion\talleresAgenciasRequest;
use Illuminate\Http\Request;
use Helpers;
use File;
use DB;

class talleresAgenciasController extends Controller
{
    public function index()
    {
        $proveedores = agenciasTalleres::getProveedores();
        return view('configuracion.agencias_talleres.index')
        ->with('proveedores', $proveedores);
    }

    public function create()
    {
        $entidades = agenciasTalleres::getEntidades();
        return view('configuracion.agencias_talleres.create')
        ->with('entidades', $entidades);
    }

    public function getMunicipios(Request $request){
        $id_estado = $request->id_estado;
        $municipios = agenciasTalleres::getMunicipios($id_estado);
        return response()->json($municipios);
    }

    public function store(talleresAgenciasRequest $request){
        // $data = $request->all();
        $proveedor = agenciasTalleres::create([
            'tipo' => $request['tipo'],
            'servicios' => $request['servicios'],
            'razon_social' => $request['razon_social'],
            'nombre_comercial' => $request['nombre_comercial'],
            'telefono_proveedor' => $request['telefono_proveedor'],
            'rfc_proveedor' => $request['rfc_proveedor'],
            'correo_proveedor' => $request['correo_proveedor'],
            'calle_proveedor' => $request['calle_proveedor'],
            'n_exterior' => $request['n_exterior'],
            'colonia' => $request['colonia'],
            'id_municipio' => $request['id_municipio'],
            'cp_proveedor' => $request['cp_proveedor'],
            'direccion_proveedor' => $request['direccion_proveedor'],
            'cx' => $request['cx'],
            'cy' => $request['cy'],
            'activo' => 1,
        ]);

        $nombre_contacto = $request->nombre_contacto;
        $numero_contacto = $request->numero_contacto;
        $correo_contacto = $request->correo_contacto;

        foreach ($nombre_contacto as $index => $nombre) {
            if (!empty($nombre) && !empty($numero_contacto[$index]) && !empty($correo_contacto[$index])) {
                $contacto = DB::table('contactos_servicios')
                ->insert([
                    'nombre_contacto' => $nombre_contacto[$index],
                    'correo_contacto' => $correo_contacto[$index],
                    'numero_contacto' => $numero_contacto[$index],
                    'id' => $proveedor->id_proveedor,
                    'tipo_contacto' => 'PROVEEDORES'
                ]);
            }
        }
        return redirect()->route('agencias_talleres/index')->with('success', 'Registro de proveedor guardado con éxito.');
    }

    public function show($id_proveedor){
        $entidades = agenciasTalleres::getEntidades();
        $municipios = agenciasTalleres::getMunicipiosAll();
        $count = agenciasTalleres::countContactos($id_proveedor);
        $proveedor = agenciasTalleres::with('contactos','municipios')->where('id_proveedor', $id_proveedor)->get();
        return view('configuracion.agencias_talleres.show')
        ->with('count', $count)
        ->with('municipios', $municipios)
        ->with('proveedor', $proveedor)
        ->with('entidades', $entidades);
    }

    public function edit($id_proveedor){
        $entidades = agenciasTalleres::getEntidades();
        $municipios = agenciasTalleres::getMunicipiosAll();
        $count = agenciasTalleres::countContactos($id_proveedor);
        $proveedor = agenciasTalleres::with('contactos','municipios')->where('id_proveedor', $id_proveedor)->get();
        return view('configuracion.agencias_talleres.edit')
        ->with('count', $count)
        ->with('municipios', $municipios)
        ->with('proveedor', $proveedor)
        ->with('entidades', $entidades);
    }

    public function update(talleresAgenciasRequest $request, $id_proveedor){
        // dd($request->all());
        $proveedor = agenciasTalleres::where('id_proveedor', $id_proveedor)->update([
            'tipo' => $request['tipo'],
            'servicios' => $request['servicios'],
            'razon_social' => $request['razon_social'],
            'nombre_comercial' => $request['nombre_comercial'],
            'telefono_proveedor' => $request['telefono_proveedor'],
            'rfc_proveedor' => $request['rfc_proveedor'],
            'correo_proveedor' => $request['correo_proveedor'],
            'calle_proveedor' => $request['calle_proveedor'],
            'n_exterior' => $request['n_exterior'],
            'colonia' => $request['colonia'],
            'id_municipio' => $request['id_municipio'],
            'cp_proveedor' => $request['cp_proveedor'],
            'direccion_proveedor' => $request['direccion_proveedor'],
            'cx' => $request['cx'],
            'cy' => $request['cy'],
            'activo' => 1,
        ]);

        $delete_contactos = agenciasTalleres::deleteContactos($id_proveedor);

        $nombre_contacto = $request->nombre_contacto;
        $numero_contacto = $request->numero_contacto;
        $correo_contacto = $request->correo_contacto;

        foreach ($nombre_contacto as $index => $nombre) {
            if (!empty($nombre) && !empty($numero_contacto[$index]) && !empty($correo_contacto[$index])) {
                $contacto = DB::table('contactos_servicios')
                ->insert([
                    'nombre_contacto' => $nombre_contacto[$index],
                    'correo_contacto' => $correo_contacto[$index],
                    'numero_contacto' => $numero_contacto[$index],
                    'id' => $id_proveedor,
                    'tipo_contacto' => 'PROVEEDORES'
                ]);
            }
        }

        return redirect()->route('agencias_talleres/index')->with('success', 'Registro de proveedor actualizado con éxito.');
    }

    public function seguimiento($id_proveedor){
        $proveedor = agenciasTalleres::getProveedoresById($id_proveedor);
        $garantias = agenciasTalleres::getGarantiasByProveedor($id_proveedor);
        if ($garantias) {
            return view('configuracion.agencias_talleres.seguimiento')
            ->with('proveedor', $proveedor)
            ->with('garantias', $garantias)
            ->with('id_proveedor', $id_proveedor);
        } else {
            return view('configuracion.agencias_talleres.seguimiento')
            ->with('proveedor', $proveedor)
            ->with('id_proveedor', $id_proveedor);
        }
    }

    public function storeGarantias(Request $request){
        // dd($request->all());
        $ruta = 'configuracion/agencias_talleres';
        $files = mover_archivos($request, ['a_g_evidencia'], null, $ruta);
        $id_proveedor = $request->id_proveedor;
        $data = $request->all();
        $data = array_merge($data,$files);
        garantiasProveedores::create($data);
        return redirect()->back()->with('success', 'Garantía de proveedor guardada con éxito.');
    }

    public function updateGarantias(Request $request, garantiasProveedores $garantiasProveedores){
        $id_proveedor = $request->id_proveedor;
        $id_garantia_proveedor = $request->id_garantia_proveedor;
        $ruta = 'configuracion/agencias_talleres';
        //Obtener datos antiguos de archivo
        $old_data = $garantiasProveedores->only(['a_g_evidencia']);
        // Manejar archivos y obtener nueva ruta 
        $files = mover_archivos($request, ['a_g_evidencia'], $old_data, $ruta);
        // Actualizar registro
        $nombre_g_proveedor = $request->nombre_g_proveedor;
        $vigencia_g_proveedor = $request->vigencia_g_proveedor;
        $monto_g_proveedor = str_replace('$','',$request->monto_g_proveedor);
        if ($request->activo == null) {
            $activo = 0;
        }else{
            $activo = 1;
        }
        // dd($nombre_g_proveedor, $vigencia_g_proveedor, $monto_g_proveedor, $activo);
        garantiasProveedores::where('id_garantia_proveedor',$id_garantia_proveedor)->update([
            'nombre_g_proveedor' => $nombre_g_proveedor,
            'vigencia_g_proveedor' => $vigencia_g_proveedor,
            'monto_g_proveedor' => $monto_g_proveedor,
            'activo' => $activo
        ]); 
        garantiasProveedores::where('id_garantia_proveedor',$id_garantia_proveedor)->update(array_merge(
            $files
        )); 
        return redirect()->back()->with('success', 'Garantía de proveedor actualizada con éxito.');
    }

}
