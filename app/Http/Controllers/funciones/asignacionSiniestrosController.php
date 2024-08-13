<?php

namespace App\Http\Controllers\funciones;

use App\Exports\siniestroExport;
use App\Models\funciones\asignacioSiniestro;
use App\Http\Controllers\Controller;
use App\Http\Requests\funciones\siniestros\siniestroRequest;
use App\Models\administracion\asignacionUnidad;
use App\Models\configuracion\cliente;
use App\Models\configuracion\unidad;
use App\Models\funciones\siniestro;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
use DB;

class asignacionSiniestrosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unidades = unidad::has('siniestros')->with(['siniestros'=> function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->get();

        $id_clientes = DB::table('usuario_clientes')
        ->select('id_cliente')
        ->where('id_usuario', Auth::user()->id)
        ->pluck('id_cliente');

        $clientes = Cliente::whereIn('id_cliente', $id_clientes)->get();

        return view('funciones.siniestros.index',compact('unidades','clientes'));
    }

    public function store(siniestroRequest $request)
    {
        $asignacioSiniestro = asignacioSiniestro::create($request->all());

        return redirect()->route('asignacionSiniestro.edit',$asignacioSiniestro);
    }

    /**
     * Display the specified resource.
     */
    public function show($asignacioSiniestro)
    {
        $registros =  asignacioSiniestro::where('id_unidad',$asignacioSiniestro)->get();
        $unidad = unidad::where('id_unidad',$asignacioSiniestro)->first();
        $clientes = cliente::all();
        $dia_actual = Carbon::now('America/Mexico_City')->now()->format('Y/m/d');
        $hora_actual = Carbon::now('America/Mexico_City')->format('H:i:s');

        return view('funciones.siniestros.informacion',compact('registros','clientes','unidad','dia_actual','hora_actual'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($asignacioSiniestro)
    {
        $registro = asignacioSiniestro::where('id_asignar_siniestro',$asignacioSiniestro)->first();
        $siniestros =  siniestro::all();

       return view('funciones.siniestros.agregarSiniestro',compact('registro','siniestros'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(siniestroRequest $request,  $registro)
    {
        $siniestro = asignacioSiniestro::where('id_asignar_siniestro',$registro)->first();
        $fechaSiniestro = Carbon::createFromFormat('d/m/Y', $request->fecha_siniestro);
        $request['fecha_siniestro'] = $fechaSiniestro->format('Y-m-d');
        $request['id_poliza_seguro'] = $siniestro->unidad->datosAseguradora->id_asignacion_seguros;
        $ruta='funciones/siniestros';
        $files = mover_archivos($request, ['a_evidencia_siniestro'],null, $ruta) ?? [];
        $files = is_array($files) ? $files : [];
        $siniestro->update(array_merge(
            $request->except(['a_evidencia_siniestro']),
            $files
        ));

        return redirect()->route('asignacionSiniestro.index')->with('success', 'Siniestro guardado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(asignacioSiniestro $asignacioSiniestro)
    {
        //
    }
    public function Unidades(Request $request)
    {
        $id_cliente = $request->input('id_cliente');

        $asignaciones = AsignacionUnidad::where('id_cliente', $id_cliente)
            ->where('activo', 1)
            ->whereHas('asignacionSeguro') // Filtrar solo asignaciones que tienen un seguro asignado
            ->with(['unidad', 'cliente', 'asignacionSeguro'])
            ->get();

        // Formatear la respuesta de acuerdo a tus necesidades
        $resultado = $asignaciones->map(function($asignacion) {
            return [
                'id_unidad' =>$asignacion->unidad->id_unidad,
                'vehiculo_id' => $asignacion->unidad->vehiculo_id,
                'modelo' => $asignacion->unidad->modelo,
                'nombre_cliente' => $asignacion->cliente->nombre_cliente,
                'placas' => $asignacion->placas
            ];
        });

        return response()->json($resultado);
    }
    public function detalles($asignacioSiniestro)
    {
        $registro = asignacioSiniestro::where('id_asignar_siniestro',$asignacioSiniestro)->first();
        $siniestros =  siniestro::all();

       return view('funciones.siniestros.show',compact('registro','siniestros'));
    }
    public function excel_ficha($unidad)
    {
        return Excel::download(new siniestroExport($unidad), 'Siniestro.xlsx');
    }
    function miRegistro(Request $request)
    {
        DB::table('llamadas_callcenter')
        ->insert([
            'modulo'=> 3,
            'id_asignacion_unidad'=>$request->id_unidad,
            'estatus'=> $request->flexRadioDefault,
            'tipo_llamada' => 0,
            'fecha' =>  Carbon::now('America/Mexico_City')->now()->format('Y-m-d'),
            'hora' => Carbon::now('America/Mexico_City')->format('H:i:s'),
            'id_callcenter'=> Auth::user()->id,
            'descripcion' => $request->descripcion
        ]);

        return redirect()->back()->with('success', 'Registro se a guardado correctamente.');
    }
}
