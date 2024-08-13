<?php

namespace App\Http\Controllers\configuracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\configuracion\gpsRequest;
use App\Models\administracion\asignacionPoliza;
use App\Models\catalogos\contactos;
use App\Models\catalogos\entidadFederativa;
use App\Models\catalogos\municipio;
use App\Models\configuracion\gps;
use Illuminate\Http\Request;

class gpsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['gps'] = gps::with('municipio')->get();
        return view('configuracion.gps.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['entidades_federativas'] = entidadFederativa::get();
        return view('configuracion.gps.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(gpsRequest $request)
    {
        $gps = gps::create([
            'razon_gps' => $request['razon_gps'],
            'nombre_gps' => $request['nombre_gps'],
            'telefono_gps' => $request['telefono_gps'],
            'rfc_gps' => $request['rfc_gps'],
            'correo_gps' => $request['correo_gps'],
            'calle_gps' => $request['calle_gps'],
            'n_exterior_gps' => $request['n_exterior_gps'],
            'colonia_gps' => $request['colonia_gps'],
            'id_municipio' => $request['id_municipio'],
            'cp_gps' => $request['cp_gps'],
            'observacion_gps' => $request['observacion_gps'],
            'activo' => $request['activo'],
        ]);

        $nombre_contactos = $request->input('nombre_contacto');
        $numero_contactos = $request->input('numero_contacto');
        $correo_contactos = $request->input('correo_contacto');

        foreach ($nombre_contactos as $index => $nombre) {
            if (!empty($nombre) && !empty($numero_contactos[$index]) && !empty($correo_contactos[$index])) {
                $contacto = new contactos();
                $contacto->id = $gps->id_gps;
                $contacto->tipo_contacto = 'GPS';
                $contacto->nombre_contacto = $nombre_contactos[$index];
                $contacto->numero_contacto = $numero_contactos[$index];
                $contacto->correo_contacto = $correo_contactos[$index];
                $contacto->save();
            }
        }

        return redirect()->route('gps.index')->with('success', 'Registro de GPS guardado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(gps $gp)
    {
        $data['gps'] = gps::find($gp->id_gps);
        $data['contactos'] = contactos::where('id', $gp->id_gps)->where('tipo_contacto', 'GPS')->get();
        $data['municipios'] = municipio::get();
        $data['entidades_federativas'] = entidadFederativa::get();
        return view('configuracion.gps.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(gps $gp)
    {
        $data['gps'] = gps::find($gp->id_gps);
        $data['contactos'] = contactos::where('id', $gp->id_gps)->where('tipo_contacto', 'GPS')->get();
        $data['municipios'] = municipio::get();
        $data['entidades_federativas'] = entidadFederativa::get();
        $data['existe'] = asignacionPoliza::where('id_gps', $gp->id_gps)
        ->where('activo', 1)
        ->exists();
        return view('configuracion.gps.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(gpsRequest $request, gps $gp)
    {
        gps::where('id_gps', $gp->id_gps)->update([
            'razon_gps' => $request['razon_gps'],
            'nombre_gps' => $request['nombre_gps'],
            'telefono_gps' => $request['telefono_gps'],
            'rfc_gps' => $request['rfc_gps'],
            'correo_gps' => $request['correo_gps'],
            'calle_gps' => $request['calle_gps'],
            'n_exterior_gps' => $request['n_exterior_gps'],
            'colonia_gps' => $request['colonia_gps'],
            'id_municipio' => $request['id_municipio'],
            'cp_gps' => $request['cp_gps'],
            'observacion_gps' => $request['observacion_gps'],
            'activo' => $request['activo'],
        ]);

        $nombre_contactos = $request->input('nombre_contacto');
        $numero_contactos = $request->input('numero_contacto');
        $correo_contactos = $request->input('correo_contacto');


        contactos::where('id', $gp->id_gps)
                ->where('tipo_contacto', 'GPS')
                ->delete();


        foreach ($nombre_contactos as $index => $nombre) {
            if (!empty($nombre) && !empty($numero_contactos[$index]) && !empty($correo_contactos[$index])) {
                $contacto = new contactos();
                $contacto->id = $gp->id_gps;
                $contacto->tipo_contacto = 'GPS';
                $contacto->nombre_contacto = $nombre_contactos[$index];
                $contacto->numero_contacto = $numero_contactos[$index];
                $contacto->correo_contacto = $correo_contactos[$index];
                $contacto->save();
            }
        }

        return redirect()->route('gps.index')->with('success', 'Registro de GPS actualizado con éxito.');
    }

}
