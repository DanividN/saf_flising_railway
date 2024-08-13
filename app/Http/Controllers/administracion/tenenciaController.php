<?php

namespace App\Http\Controllers\administracion;

use App\Exports\tenenciaExport;
use App\Models\administracion\tenencia;
use App\Http\Controllers\Controller;
use App\Http\Requests\administracion\tenenciaRequest;
use App\Models\administracion\asignacionUnidad;
use App\Models\configuracion\unidad;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class tenenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unidad_id = Session::get('unidad');
        $unidad = unidad::where('id_unidad',$unidad_id)->first();
        $tenencias = tenencia::where('id_unidad',$unidad_id)->get();

        return view('administracion.tenencias.informacion',compact('tenencias','unidad'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unidad_id = Session::get('unidad');
        $unidad = unidad::where('id_unidad',$unidad_id)->first();

        return view('administracion.tenencias.agregarTenencias',compact('unidad'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(tenenciaRequest $request)
    {
        $unidad_id = Session::get('unidad');
        $unidad = unidad::where('id_unidad',$unidad_id)->first();
        $ultimoArrendamiento = $unidad->UltimoArrendamiento;
        $fechaPago = Carbon::createFromFormat('d/m/Y', $request->fecha_pago);
        $monto_tenencia = floatval(str_replace(',', '', $request->monto_tenencia));
        // Verifica si la fecha es del año actual
        if ($fechaPago->year != Carbon::now()->year) {
            return redirect()->back()->withErrors(['fecha_pago' => 'La fecha debe pertenecer al año actual.']);
        }

        $request['arrendamiento_id'] = ($ultimoArrendamiento && $ultimoArrendamiento->activo) ? $ultimoArrendamiento->id_asignacion_unidad : null;
        $request['fecha_pago'] = $fechaPago->format('Y-m-d');
        $request['id_unidad'] = $unidad_id;
        $ruta='administracion/tenencia';
        $files = mover_archivos($request, ['a_evidencia_tenencia'], null,$ruta);
        $data = $request->all();
        $data = array_merge($data,$files);
        $data['monto_tenencia'] = $monto_tenencia;
        tenencia::create($data);

        return redirect()->route('tenencias.index')->with('success', 'Registro de tenencia guardado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(tenencia  $tenencia)
    {
        return view('administracion.tenencias.show',compact('tenencia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($tenencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tenencia $tenencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tenencia $tenencia)
    {
        //
    }
    public function excel_ficha($unidad)
    {
        return Excel::download(new tenenciaExport($unidad), 'tenencia.xlsx');
    }
}
