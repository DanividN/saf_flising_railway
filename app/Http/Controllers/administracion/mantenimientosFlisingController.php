<?php

namespace App\Http\Controllers\administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\administracion\mantenimientosFlising;
use App\Models\funciones\MantenimientoCallCenter;
use App\Models\configuracion\unidad;
use Carbon\Carbon;
use Auth;
use DB;

class mantenimientosFlisingController extends Controller
{
    public function index(){
        //
        $unidades = unidad::with('UltimoArrendamiento.Cliente', 'UltimaVerificacion.Seguimiento', 'marca','citas_mantenimiento','anio')->whereHas('UltimoArrendamiento', function ($q) {
            $q->where('activo', '0')->whereNotNull('placas');
        })->get();
        //dd($unidades);
        return view('administracion.mantenimientos.index')
        ->with('unidades', $unidades);
    }

    public function create($unidad_id){
        //
        $mantenimientos = MantenimientoCallCenter::with('asignacion_unidad','unidad','unidad.marca', 'asignacion_unidad.cliente','asignacion_unidad.responsable',
        'seguimiento_mantenimiento','proveedor')
        ->where('id_unidad', $unidad_id)->get();
        $entidad_federativa = MantenimientoCallCenter::getEntidad();
        $info_unidad = MantenimientoCallCenter::getInfoUnidad($unidad_id);
        $count_pendientes = MantenimientoCallCenter::getPendientes($unidad_id);
        return view('administracion.mantenimientos.informacion')
        ->with('unidad_id', $unidad_id)
        ->with('mantenimientos', $mantenimientos)
        ->with('entidad_federativa', $entidad_federativa);
    }

    public function getProveedores(Request $request){
        $id_municipio = $request->id_municipio;
        $proveedores = MantenimientoCallCenter::getProveedores($id_municipio);
        return response()->json($proveedores);
    }

    public function getProveedoresDireccion(Request $request){
        $id_proveedor = $request->id_proveedor;
        $proveedores_dir = MantenimientoCallCenter::getProveedoresDir($id_proveedor);
        return response()->json($proveedores_dir);
    }

    public function getFechaMantenimiento(Request $request){
        //dd($request->all());
        $id_unidad = $request->id_unidad;
        $fecha_mant = MantenimientoCallCenter::getFechaMantenimiento($id_unidad);
        return response()->json($fecha_mant);
    }

    public function seguimientoMantenimiento($id_cita_mantenimiento){
        $info_mantenimiento = MantenimientoCallCenter::with('asignacion_unidad.cliente','asignacion_unidad.responsable','unidad.tipo_unidad','poliza','poliza.polizas',
        'unidad.marca','poliza.gps','poliza.aseguradora','proveedor','seguimiento_mantenimiento')
        ->where('id_citas_mantenimiento', $id_cita_mantenimiento)->get();
        //dd($info_mantenimiento);
        return view('administracion.mantenimientos.show')
        ->with('info_mantenimiento', $info_mantenimiento);
    }

    public function store(Request $request){
        //dd($request->all());
        $id_unidad = $request->id_unidad;
        $file_pdf = $request->file('a_cita_mantenimiento');
        $datos['id_municipio'] = $request->id_municipio;
        $datos['id_proveedor'] = $request->id_proveedor;
        $datos['id_unidad'] = $request->id_unidad;
        $datos['tipo_mantenimiento'] = $request->tipo_mantenimiento;
        $date_ma = Carbon::createFromFormat('d/m/Y', $request->fecha_mantenimiento)->format('Y-m-d');
        $datos['fecha_mantenimiento'] = $date_ma;
        $datos['hora_mantenimiento'] = $request->hora_mantenimiento;
        $datos['estado'] = 'AGENDADO';
        $ruta = 'funciones/agenda_mantenimiento';
        $files = mover_archivos($request, ['a_cita_mantenimiento'], null, $ruta);
        $data = array_merge($datos,$files);  
        $id_cita_mantenimiento = DB::table('citas_mantenimiento')->insertGetId($data);
        $inicio_folio = $id_cita_mantenimiento;
        $ceros = str_pad($inicio_folio, 4, "0", STR_PAD_LEFT);
        $folio = 'MA-'.$ceros;
        $update_folio_cita = DB::table('citas_mantenimiento')
        ->where('id_citas_mantenimiento',$id_cita_mantenimiento)
        ->update([
            'folio_agendado' => $folio,
        ]);
        return redirect()->back()->with('success', 'Cita de mantenimiento agendada con éxito');
    }

    public function storeSeguimientoMantenimiento(Request $request){
        //dd($request->all());
        $unidad_id = $request->id_unidad;
        if($request->status_cancelado == 'CANCELADO'){
            $update_cita = DB::table('citas_mantenimiento')
            ->where('citas_mantenimiento.id_citas_mantenimiento',$request->id_citas_mantenimiento)
            ->update([
                'estado' => 'CANCELADO'
            ]);
        }else{
            $datos['id_citas_mantenimiento'] = $request->id_citas_mantenimiento;
            if($request->tipo_mantenimiento == 'KILOMETRAJE'){
                $datos['tipo_mantenimiento'] = 1;
            }else{
                $datos['tipo_mantenimiento'] = 2;
            }
            $date = $request->fecha_mantenimiento;
            $date_mantenimiento = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
            // dd($date_mantenimiento);
            $datos['fecha_mantenimiento'] = $date_mantenimiento;
            $datos['monto_mantenimiento'] = str_replace(',', '', $request->monto_mantenimiento);
            if ($request->autorizacion == 'Avanzado') {
                $datos['autorizacion'] = 2;
                $datos['status_autorizacion'] = 1; //Pendiente
            } else {
                $datos['autorizacion'] = 1;
                $datos['status_autorizacion'] = 2; //Aceptado
            }
            $datos['observaciones_call'] = $request->observaciones_call;
            $datos['fecha_solicitud'] = date('Y-m-d');
            $ruta = 'funciones/seguimiento_mantenimiento';
            if($request->a_factura == null){
                $files = mover_archivos($request, ['a_cotizacion'], null, $ruta);
                $data = array_merge($datos,$files);
                $update_estado = DB::table('citas_mantenimiento')
                ->where('id_citas_mantenimiento',$request->id_citas_mantenimiento)
                ->update([
                    'estado' => 'PENDIENTE'
                ]);
                //dd($data);
                $id_seguimiento = DB::table('seguimiento_mantenimiento')->insertGetId($data);
            }else{
                $files = mover_archivos($request, ['a_factura','a_cotizacion'], null, $ruta);
                $data = array_merge($datos,$files); 
                $folio_agendado = DB::table('citas_mantenimiento')
                ->select('folio_agendado')
                ->where('id_citas_mantenimiento',$request->id_citas_mantenimiento)
                ->get();
                $update_unidad = DB::table('unidades')
                ->where('id_unidad',$request->id_unidad)
                ->update([
                    'kilometraje' => $request->kilometraje,
                    'fecha_mantenimiento' => $date_mantenimiento
                ]);
                //dd($folio);
                if($request->estatus_pago == null){
                    $update_estado = DB::table('citas_mantenimiento')
                    ->where('id_citas_mantenimiento',$request->id_citas_mantenimiento)
                    ->update([
                        'estado' => 'CONCLUIDO'
                    ]);
                }else{
                    $update_cita = DB::table('citas_mantenimiento')
                    ->where('id_citas_mantenimiento', $request->id_citas_mantenimiento)
                    ->update([
                        'estado' => 'PAGADO'
                    ]);
                }
                $id_seguimiento = DB::table('seguimiento_mantenimiento')->insertGetId($data);
                $inicio_folio = DB::table('seguimiento_mantenimiento')->max('num');
                $ceros = str_pad($inicio_folio + 1, 4, "0", STR_PAD_LEFT);
                $folio = 'MC-'.$ceros;
                $num = $inicio_folio + 1;
                $update_folio_seguimiento = DB::table('seguimiento_mantenimiento')
                ->where('id_citas_mantenimiento', $request->id_citas_mantenimiento)
                ->update([
                    'folio_completado' => $folio,
                    'num' => $num
                ]);
            }
            if($request->estatus_pago != null){
                $update_cita = DB::table('seguimiento_mantenimiento')
                ->where('id_citas_mantenimiento', $request->id_citas_mantenimiento)
                ->update([
                    'estatus_pago' => 2
                ]);
            }
        }
        return redirect('administracion/mantenimientos/show/'.$unidad_id)->with('success', 'Cita de mantenimiento agendada con éxito');
    }

    public function aceptado($id_cita_mantenimiento){
        $info_mantenimiento = MantenimientoCallCenter::with('asignacion_unidad.cliente','asignacion_unidad.responsable','unidad.tipo_unidad','poliza','poliza.polizas',
        'unidad.marca','poliza.gps','poliza.aseguradora','proveedor','seguimiento_mantenimiento')
        ->where('id_citas_mantenimiento', $id_cita_mantenimiento)->get();
        //dd($info_mantenimiento);
        return view('administracion.mantenimientos.show_autorizado')
        ->with('info_mantenimiento', $info_mantenimiento);
    }

    public function rechazado($id_cita_mantenimiento){
        $info_mantenimiento = MantenimientoCallCenter::with('asignacion_unidad.cliente','asignacion_unidad.responsable','unidad.tipo_unidad','poliza','poliza.polizas',
        'unidad.marca','poliza.gps','poliza.aseguradora','proveedor','seguimiento_mantenimiento')
        ->where('id_citas_mantenimiento', $id_cita_mantenimiento)->get();
        //dd($info_mantenimiento);
        return view('administracion.mantenimientos.show_rechazado')
        ->with('info_mantenimiento', $info_mantenimiento);
    }

    public function pendiente($id_cita_mantenimiento){
        $info_mantenimiento = MantenimientoCallCenter::with('asignacion_unidad.cliente','asignacion_unidad.responsable','unidad.tipo_unidad','poliza','poliza.polizas',
        'unidad.marca','poliza.gps','poliza.aseguradora','proveedor','seguimiento_mantenimiento')
        ->where('id_citas_mantenimiento', $id_cita_mantenimiento)->get();
        //dd($info_mantenimiento);
        return view('administracion.mantenimientos.show_pendiente')
        ->with('info_mantenimiento', $info_mantenimiento);
    }

    public function update(Request $request){
        //dd($request->all());
        $id_cita_mantenimiento = $request->id_citas_mantenimiento;
        $estatus_pago = $request->estatus_pago;
        $ruta = 'funciones/seguimiento_mantenimiento';
        $files = mover_archivos($request, ['a_factura'], null, $ruta);
        $datos['estatus_pago'] = 2;
        $data = array_merge($datos,$files);
        if($estatus_pago == null){
            $update_cita = DB::table('citas_mantenimiento')
            ->where('id_citas_mantenimiento',$id_cita_mantenimiento)
            ->update([
                'estado' => 'CONCLUIDO'
            ]);
            if($files != null){
                $update_seguimiento = DB::table('seguimiento_mantenimiento')
                ->where('id_citas_mantenimiento',$id_cita_mantenimiento)
                ->update(array_merge(
                    $files
                ));
            }
            $inicio_folio = DB::table('seguimiento_mantenimiento')->max('num');
            if($inicio_folio == 0){
                $folio_count = 1;
            }else{
                $folio_count = $inicio_folio + 1;
            }
            $ceros = str_pad($folio_count, 4, "0", STR_PAD_LEFT);
            $folio = 'MC-'.$ceros;
            $update_folio_seguimiento = DB::table('seguimiento_mantenimiento')
            ->where('id_citas_mantenimiento',$request->id_citas_mantenimiento)
            ->update([
                'folio_completado' => $folio,
                'num' => $folio_count
            ]);
            $fecha_cita = $request->fecha_cita;
            $date = $request->fecha_mantenimiento;
            if($date != $fecha_cita){
                // dd('Transformar', $fecha_cita, $date);
                $date_mantenimiento = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
            }else{
                $date_mantenimiento = $request->fecha_mantenimiento;
            }
            $kilometraje = str_replace(",","",$request->kilometraje);
            $update_unidad = DB::table('unidades')
            ->where('id_unidad',$request->id_unidad)
            ->update([
                'kilometraje' => $kilometraje,
                'fecha_mantenimiento' => $date_mantenimiento
            ]);
        }else{
            $update_cita = DB::table('citas_mantenimiento')
            ->where('id_citas_mantenimiento',$id_cita_mantenimiento)
            ->update([
                'estado' => 'PAGADO'
            ]);
            if($files != null){
                $update_seguimiento = DB::table('seguimiento_mantenimiento')
                ->where('id_citas_mantenimiento',$id_cita_mantenimiento)
                ->update(array_merge(
                    $data
                ));
            }
            $update_cita = DB::table('seguimiento_mantenimiento')
            ->where('id_citas_mantenimiento', $id_cita_mantenimiento)
            ->update([
                'estatus_pago' => 2
            ]);
            $last_folio = DB::table('seguimiento_mantenimiento')
            ->select('folio_completado')
            ->where('id_citas_mantenimiento',$id_cita_mantenimiento)
            ->get();
            if($last_folio[0]->folio_completado == null){
                $inicio_folio = DB::table('seguimiento_mantenimiento')->max('num');
                if($inicio_folio == 0){
                    $folio_count = 1;
                }else{
                    $folio_count = $inicio_folio + 1;
                }
                $ceros = str_pad($folio_count, 4, "0", STR_PAD_LEFT);
                $folio = 'MC-'.$ceros;
                $update_folio_seguimiento = DB::table('seguimiento_mantenimiento')
                ->where('id_citas_mantenimiento',$request->id_citas_mantenimiento)
                ->update([
                    'folio_completado' => $folio,
                    'num' => $folio_count
                ]);
            }
            $fecha_cita = $request->fecha_cita;
            $date = $request->fecha_mantenimiento;
            if($date != $fecha_cita){
                $date_mantenimiento = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
            }else{
                $date_mantenimiento = $request->fecha_mantenimiento;
            }
            $unidad = $request->id_unidad;
            $kilometraje = str_replace(",","",$request->kilometraje);
            $update_unidad = DB::table('unidades')
            ->where('id_unidad',$unidad)
            ->update([
                'kilometraje' => $kilometraje,
                'fecha_mantenimiento' => $date_mantenimiento
            ]);
        }
        $unidad = $request->id_unidad;
        return redirect('administracion/mantenimientos/show/'.$unidad)->with('success', 'Cita de mantenimiento actualizada con éxito');
    }
}
