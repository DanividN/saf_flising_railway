<?php

namespace App\Http\Controllers\funciones;

use App\Exports\emergenciasExport;
use App\Http\Controllers\Controller;
use App\Models\administracion\asignacionUnidad;
use App\Models\catalogos\emergencias;
use App\Models\configuracion\cliente;
use App\Models\configuracion\unidad;
use App\Models\funciones\emergenciasCall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class emergenciasCallController extends Controller
{
    public function index(){
        $id_user = Auth::user()->id;
        $data['clientes'] = emergenciasCall::getClientes($id_user);
        $data['tipos_emergencias'] = emergencias::get();
        $data['emergencias'] = emergenciasCall::getUnidadesEmergencia($id_user);
        return view('funciones.emergencias.index', $data);
    }

    public function store(Request $request){
        $datos = $request->all();
        $exists = emergenciasCall::where('id_asignacion_unidad', $datos['id_asignacion_unidad'])
            ->where('estado_emergencia', 1)
            ->exists();
        if ($exists) {
            return redirect()->back()->with('error', 'Ya existe una emergencia en proceso para esta unidad.');
        }
        emergenciasCall::create($datos);

        return redirect()->back()->with('success', 'Emergencia agregada con éxito.');
    }

    public function info($emergencia){
        $data['emergencias'] = emergenciasCall::getEmergencia($emergencia);
        return view('funciones.emergencias.info', $data);
    }

    public function show($emergencia){
        $data['emergencia'] = emergenciasCall::showEmergencia($emergencia);
        return view('funciones.emergencias.show', $data);
    }

    public function llamadaStore(Request $request){
        $data = $request->all();
        emergenciasCall::llamadaStore($data);
        return redirect()->back()->with('success', 'Llamada registrada con éxito.');
    }

    public function unidadesAsignadas($id_cliente)
    {
        $unidades = asignacionUnidad::where('id_cliente', $id_cliente)->where('activo', 1)->get();
        return response()->json($unidades);
    }

    public function responsableAsignado($id_unidad)
    {
        $unidades = asignacionUnidad::where('id_asignacion_unidad', $id_unidad)->where('activo', 1)->get();
        return response()->json($unidades);
    }

    public function informeEmergencias($emergencia){
        return Excel::download(new emergenciasExport($emergencia), 'informe-emergencias.xlsx');
    }
}
