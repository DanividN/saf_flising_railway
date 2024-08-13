<?php

namespace App\Http\Controllers\configuracion;

use App\Http\Controllers\Controller;
use App\Models\catalogos\contactos;
use App\Models\catalogos\entidadFederativa;
use App\Models\catalogos\municipio;
use App\Models\configuracion\aseguradora;
use Illuminate\Http\Request;
use App\Http\Requests\configuracion\aseguradoraRequest;
use App\Http\Requests\configuracion\polizasRequest;
use App\Models\administracion\asignacionPoliza;
use App\Models\catalogos\polizaSeguro;

class aseguradoraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['aseguradoras'] = aseguradora::with('municipio')->get();
        return view('configuracion.aseguradoras.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['entidades_federativas'] = entidadFederativa::get();
        return view('configuracion.aseguradoras.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(aseguradoraRequest $request)
    {
        $aseguradora = aseguradora::create([
            'razon_aseguradora' => $request['razon_aseguradora'],
            'nombre_aseguradora' => $request['nombre_aseguradora'],
            'telefono_aseguradora' => $request['telefono_aseguradora'],
            'rfc_aseguradora' => $request['rfc_aseguradora'],
            'correo_aseguradora' => $request['correo_aseguradora'],
            'calle_aseguradora' => $request['calle_aseguradora'],
            'n_exterior_aseguradora' => $request['n_exterior_aseguradora'],
            'colonia_aseguradora' => $request['colonia_aseguradora'],
            'id_municipio' => $request['id_municipio'],
            'cp_aseguradora' => $request['cp_aseguradora'],
            'activo' => $request['activo'],
        ]);
        $nombre_contactos = $request->input('nombre_contacto');
        $numero_contactos = $request->input('numero_contacto');
        $correo_contactos = $request->input('correo_contacto');

        foreach ($nombre_contactos as $index => $nombre) {
            if (!empty($nombre) && !empty($numero_contactos[$index]) && !empty($correo_contactos[$index])) {
                $contacto = new contactos();
                $contacto->id = $aseguradora->id_aseguradora;
                $contacto->tipo_contacto = 'ASEGURADORAS';
                $contacto->nombre_contacto = $nombre_contactos[$index];
                $contacto->numero_contacto = $numero_contactos[$index];
                $contacto->correo_contacto = $correo_contactos[$index];
                $contacto->save();
            }
        }

        return redirect()->route('aseguradoras.index')->with('success', 'Aseguradora guardada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(aseguradora $aseguradora)
    {
        $data['aseguradora'] = aseguradora::find($aseguradora->id_aseguradora);
        $data['contactos'] = contactos::where('id', $aseguradora->id_aseguradora)->where('tipo_contacto', 'ASEGURADORAS')->get();
        $data['municipios'] = municipio::get();
        $data['entidades_federativas'] = entidadFederativa::get();
        return view('configuracion.aseguradoras.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(aseguradora $aseguradora)
    {
        $data['aseguradora'] = aseguradora::find($aseguradora->id_aseguradora);
        $data['contactos'] = contactos::where('id', $aseguradora->id_aseguradora)->where('tipo_contacto', 'ASEGURADORAS')->get();
        $data['municipios'] = municipio::get();
        $data['entidades_federativas'] = entidadFederativa::get();
        $data['existe'] = asignacionPoliza::where('id_aseguradora', $aseguradora->id_aseguradora)
        ->where('activo', 1)
        ->exists();
        return view('configuracion.aseguradoras.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, aseguradora $aseguradora)
    {
        aseguradora::where('id_aseguradora', $aseguradora->id_aseguradora)->update([
            'razon_aseguradora' => $request['razon_aseguradora'],
            'nombre_aseguradora' => $request['nombre_aseguradora'],
            'telefono_aseguradora' => $request['telefono_aseguradora'],
            'rfc_aseguradora' => $request['rfc_aseguradora'],
            'correo_aseguradora' => $request['correo_aseguradora'],
            'calle_aseguradora' => $request['calle_aseguradora'],
            'n_exterior_aseguradora' => $request['n_exterior_aseguradora'],
            'colonia_aseguradora' => $request['colonia_aseguradora'],
            'id_municipio' => $request['id_municipio'],
            'cp_aseguradora' => $request['cp_aseguradora'],
            'activo' => $request['activo'],
        ]);

        $nombre_contactos = $request->input('nombre_contacto');
        $numero_contactos = $request->input('numero_contacto');
        $correo_contactos = $request->input('correo_contacto');


        contactos::where('id', $aseguradora->id_aseguradora)
                ->where('tipo_contacto', 'ASEGURADORAS')
                ->delete();


        foreach ($nombre_contactos as $index => $nombre) {
            if (!empty($nombre) && !empty($numero_contactos[$index]) && !empty($correo_contactos[$index])) {
                $contacto = new contactos();
                $contacto->id = $aseguradora->id_aseguradora;
                $contacto->tipo_contacto = 'ASEGURADORAS';
                $contacto->nombre_contacto = $nombre_contactos[$index];
                $contacto->numero_contacto = $numero_contactos[$index];
                $contacto->correo_contacto = $correo_contactos[$index];
                $contacto->save();
            }
        }

        return redirect()->route('aseguradoras.index')->with('success', 'Aseguradora actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function tracking(aseguradora $aseguradora)
    {
        $data['aseguradora'] = aseguradora::find($aseguradora);
        $data['municipios'] = municipio::get();
        $data['polizas'] = polizaSeguro::where('id_aseguradora', $aseguradora->id_aseguradora)->get();
        return view('configuracion.aseguradoras.seguimiento.tracking', $data);
    }

    public function trackingStore(Request $request){

        if ($request->activo == null) {
            $activo = 0;
        } else {
            $activo = 1;
        }

        $ruta = 'configuracion/polizas';
        $files = mover_archivos($request, ['a_poliza'], null, $ruta);

        $data = $request->all();
        $data['activo'] = $activo;
        $data = array_merge($data, $files);
        $id_aseguradora = $request->get('id_aseguradora');

        polizaSeguro::create($data);

        return redirect()->route('aseguradoras.tracking', ['aseguradora' => $id_aseguradora])
                        ->with('success', 'Póliza de aseguradora guardada con éxito.');

    }

    public function trackingUpdate(Request $request, polizaSeguro $poliza){

        $id_aseguradora = $request->get('id_aseguradora');

        $ruta = 'configuracion/agencias_talleres';
        $old_data = $poliza->only(['a_poliza']);
        $files = mover_archivos($request, ['a_poliza'], $old_data, $ruta);

        if ($request->activo == null) {
            $request['activo'] = 0;
        } else {
            $request['activo'] = 1;
        }


        polizaSeguro::where('id_poliza_seguro', $poliza->id_poliza_seguro)->update([
            'nombre_poliza' => $request['nombre_poliza'],
            'dano_material' => $request['dano_material'],
            'robo_total' => $request['robo_total'],
            'activo' => $request['activo']
        ]);

        polizaSeguro::where('id_poliza_seguro',$poliza->id_poliza_seguro)->update(array_merge(
            $files
        ));

        return redirect()->route('aseguradoras.tracking',['aseguradora'=> $id_aseguradora ])->with('success', 'Póliza de aseguradora actualizada con éxito.');
    }
}
