<?php

namespace App\Http\Controllers\administracion;

use App\Exports\asignacionPolizaExport;
use App\Http\Controllers\Controller;
use App\Models\administracion\asignacionPoliza;
use App\Models\configuracion\aseguradora;
use App\Models\configuracion\gps;
use App\Models\configuracion\unidad;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class asignacionPolizaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estados = [5, 6, 7];
        $data['unidades'] = unidad::with(['marca',
        'datosAseguradora.gps',
        'datosAseguradora.polizas',
        'datosAsignacion' => function ($query) {
            $query->withoutGlobalScopes();
        }])
        ->where(function ($query) use ($estados) {
            $query->whereNotIn('id_estado', $estados)->orWhereNull('id_estado');
        })->get();
        return view('administracion.seguroGPS.index', $data);
    }

    public function addSeguro($unidad){
        $data['unidades'] = unidad::with([
            'marca',
            'tipo_unidad',
            'datosAsignacion' => function ($query) {
                $query->withoutGlobalScopes();
            },
            'datosAsignacion.responsable',
            'datosAsignacion.cliente',
        ])->where('id_unidad', $unidad)->get();
        $data['aseguradoras'] = aseguradora::get();
        $data['d_gps'] = gps::get();
        return view('administracion.seguroGPS.create', $data);
    }

    public function storeSeguro(Request $request){
        $monto_seguro = str_replace(",", "",$request->monto_seguro);
        $monto_seguro = (float) $monto_seguro;

        $monto_deducible_seguro = str_replace(",", "",$request->monto_deducible_seguro);
        $monto_deducible_seguro = (float) $monto_deducible_seguro;

        $fechaPago = Carbon::createFromFormat('d/m/Y', $request->fecha_pago);
        $fechaPago = $fechaPago->format('Y-m-d');

        $fechaVencimiento = Carbon::createFromFormat('d/m/Y', $request->fecha_vencimiento);
        $fechaVencimiento = $fechaVencimiento->format('Y-m-d');

        $fechaInicio = Carbon::createFromFormat('d/m/Y', $request->fecha_inicio);
        $fechaInicio = $fechaInicio->format('Y-m-d');

        $id_unidad = $request->id_unidad;
        $currentTimestamp = time();
        $limiteTimestamp = strtotime('-11 months', $currentTimestamp);
        $limiteFechaPago = date('Y-m-d', $limiteTimestamp);
        $ultimoRegistro = AsignacionPoliza::where('id_unidad', $id_unidad)
                            ->latest()
                            ->first();

        if ($ultimoRegistro !== null && $ultimoRegistro->fecha_pago >= $limiteFechaPago) {
            return redirect()->back()->with('error', 'No se puede crear el registro porque la vigencia de la unidad sigue activa.');
        }

        $ruta = 'administracion/aseguradoraGPS';
        $files = mover_archivos($request, ['a_evidencia','a_poliza'], null, $ruta);

        $data = $request->all();
        $data['monto_seguro'] = $monto_seguro;
        $data['monto_deducible_seguro'] = $monto_deducible_seguro;
        $data['fecha_pago'] = $fechaPago;
        $data['fecha_vencimiento'] = $fechaVencimiento;
        $data['fecha_inicio'] = $fechaInicio;

        $data = array_merge($data,$files);
        asignacionPoliza::create($data);
        return redirect()->route('asignacionPoliza.index')->with('success', 'Póliza de aseguradora guardada con éxito.');
    }

    public function info($unidad){
        $data['unidad'] = $unidad;

        $currentTimestamp = time();
        $limiteTimestamp = strtotime('-11 months', $currentTimestamp);
        $limiteFechaPago = date('Y-m-d', $limiteTimestamp);
        $ultimoRegistro = AsignacionPoliza::where('id_unidad', $unidad)
                            ->latest()
                            ->first();

        if ($ultimoRegistro !== null && $ultimoRegistro->fecha_pago >= $limiteFechaPago) {
            $data['existe'] = 1;
        } else {
            $data['existe'] = 0;
        }

        $data['polizaAsiganada'] = asignacionPoliza::with([
                'unidad.datosAsignacion',
                'unidad.marca',
                'unidad.tipo_unidad',
                'unidad.datosAsignacion.responsable',
                'unidad.datosAsignacion.cliente',
                'unidad.datosAseguradora.gps',
                'unidad.datosAseguradora.polizas',
                'aseguradora'
            ])->where('id_unidad',$unidad)->orderBy('id_asignacion_seguros', 'DESC')->get();
        return view('administracion.seguroGPS.info', $data);
    }

    public function show($id_asignacion_seguros){
        $data['asignacionPoliza'] = asignacionPoliza::with([
                'unidad.datosAsignacion',
                'unidad.marca',
                'unidad.tipo_unidad',
                'unidad.datosAsignacion.responsable',
                'unidad.datosAsignacion.cliente',
                'aseguradora'
            ])->where('id_asignacion_seguros',$id_asignacion_seguros)->first();
        return view('administracion.seguroGPS.show', $data);
    }

    public function informePolizas($id_unidad){
        return Excel::download(new asignacionPolizaExport($id_unidad), 'informe-pólizas.xlsx');
    }
}
