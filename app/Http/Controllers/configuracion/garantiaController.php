<?php

namespace App\Http\Controllers\configuracion;

use Illuminate\Validation\Rule;
use App\Models\catalogos\contactos;
use App\Models\catalogos\municipio;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\catalogos\entidadFederativa;
use App\Models\configuracion\garantia\garantia;
use App\Http\Requests\configuracion\garantias\garantiaRequest;
use App\Http\Requests\configuracion\garantias\garantiaUpdateRequest;


class garantiaController extends Controller
{
    public function index()
    {
       $proveedor = garantia::select(
        'id_g_flising',
        'nombre_comercial',
        'razon_social',
        'rfc_g_flising',
        'created_at',
        'telefono_g_flising',
        'id_municipio'
       )
       ->orderBy('id_g_flising', 'desc')
       ->get();

       $municipios = municipio::all();
        $e = 1;
        return view('configuracion.garantias.index',[
            'proveedor' => $proveedor,
            'e' => $e,
            'municipios' => $municipios
        ]);
    }


    public function create()
    {
        $entidadesFederativas = entidadFederativa::all();
        return view('configuracion.garantias.create',[
            'entidadesFederativas' => $entidadesFederativas
        ]);
    }

    public function store(garantiaRequest $req)
    {
        $garantia = garantia::create([
            'razon_social' => $req['razon_social'],
            'nombre_comercial' => $req['nombre_comercial'],
            'telefono_g_flising' => $req['telefono_g_flising'],
            'rfc_g_flising' => $req['rfc_g_flising'],
            'correo_g_flising' => $req['correo_g_flising'],
            'calle_g_flising' => $req['calle_g_flising'],
            'n_exterior_g_flising' => $req['n_exterior_g_flising'],
            'colonia_g_flising' => $req['colonia_g_flising'],
            'id_municipio' => $req['id_municipio'],
            'cp_g_flising' => $req['cp_g_flising'],
            'activo' => 1
        ]);

        $nombre_contactos = $req->input('nombre_contacto');
        $numero_contactos = $req->input('numero_contacto');
        $correo_contactos = $req->input('correo_contacto');

        foreach ($nombre_contactos as $index => $nombre) {
            if (!empty($nombre) && !empty($numero_contactos[$index]) && !empty($correo_contactos[$index])) {
                $contacto = new contactos();
                $contacto->id = $garantia->id_g_flising;
                $contacto->tipo_contacto = 'GARANTIAS_FLISING';
                $contacto->nombre_contacto = $nombre_contactos[$index];
                $contacto->numero_contacto = $numero_contactos[$index];
                $contacto->correo_contacto = $correo_contactos[$index];
                $contacto->save();
            }
        }
        return redirect()->route('garantias.index')
        ->with('success', 'Proveedor agregado exitosamente');
        
    }

    public function show(garantia $garantia){
        Session::put('garantia', $garantia);

        return redirect()->route('garantias_seguimiento.index');
    }

    public function edit(garantia $garantia)
    {
        
        $contactos = contactos::where('id', $garantia->id_g_flising)
        ->where('tipo_contacto','GARANTIAS_FLISING')
        ->get()
        ->toArray();
        $municipioSeleccionado = municipio::select('id_entidad_federativa','id_municipio')
            ->where('id_municipio', $garantia->id_municipio)
            ->first();


        $municipiosAll = municipio::all();

        $entidadesFederativas = entidadFederativa::all();
       
        return view('configuracion.garantias.edit', [
            'municipioSeleccionado' => $municipioSeleccionado,
            'garantia' => $garantia,
            'entidadesFederativas' => $entidadesFederativas,
            'contactos' => $contactos,
            'municipiosAll' => $municipiosAll,
            'e' => 1,
        ]);
    }
    
    public function update(garantiaUpdateRequest $req, garantia $garantia)
    {
        $this->validate($req, [
            'correo_g_flising' => ['required', 'email', 'unique:garantias_flising,correo_g_flising,' . $garantia->id_g_flising . ',id_g_flising'],
        ]);

        $updateGarantia = garantia::findOrFail($garantia->id_g_flising);

        $updateGarantia->fill([
            'razon_social'          =>  $req->razon_social,
            'nombre_comercial'      =>  $req->nombre_comercial,
            'telefono_g_flising'    =>  $req->telefono_g_flising,
            'rfc_g_flising'         =>  $req->rfc_g_flising,
            'correo_g_flising'      =>  $req->correo_g_flising,
            'calle_g_flising'       =>  $req->calle_g_flising,
            'n_exterior_g_flising'  =>  $req->n_exterior_g_flising,
            'colonia_g_flising'     =>  $req->colonia_g_flising,
            'id_municipio'          =>  $req->id_municipio,
            'cp_g_flising'          =>  $req->cp_g_flising,
            'activo'                =>  1,
        ]);
        
        $updateGarantia->save();

        $nombre_contactos = $req->input('nombre_contacto');
        $numero_contactos = $req->input('numero_contacto');
        $correo_contactos = $req->input('correo_contacto');
        $contacto_ids = $req->input('contacto_id');

        foreach ($contacto_ids as $index => $contacto_id) {
            $contacto = contactos::find($contacto_id);
            if ($contacto) {
                if (!empty($nombre_contactos[$index]) || !empty($numero_contactos[$index]) || !empty($correo_contactos[$index])) {
                    $contacto->nombre_contacto = $nombre_contactos[$index];
                    $contacto->numero_contacto = $numero_contactos[$index];
                    $contacto->correo_contacto = $correo_contactos[$index];
                    $contacto->save();
                } else {
                    $contacto->delete();
                }
            } else {
                if (!empty($nombre_contactos[$index]) || !empty($numero_contactos[$index]) || !empty($correo_contactos[$index])) {
                    contactos::create([
                        'nombre_contacto' => $nombre_contactos[$index],
                        'correo_contacto' => $correo_contactos[$index],
                        'numero_contacto' => $numero_contactos[$index],
                        'id' => $garantia->id_g_flising,
                        'tipo_contacto' => 'GARANTIAS_FLISING'
                    ]);
                    
                }
            }
        }

        return redirect()->route('garantias.index')
        ->with('success', 'Proveedor actualizado exitosamente');
    }

    public function getMunicipios($id){
        $municipios = '';
        
        if($id == 1){
            $municipios = municipio::where('id_entidad_federativa',$id)->get();
        }else if ($id == 2){
            $municipios = municipio::where('id_entidad_federativa',$id)->get();
        }
        return response()->json($municipios);
    }
}
