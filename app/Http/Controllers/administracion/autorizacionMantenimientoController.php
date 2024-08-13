<?php

namespace App\Http\Controllers\administracion;

use App\Http\Controllers\Controller;
use App\Models\funciones\seguimientoMantenimiento;
use App\Models\funciones\MantenimientoCallCenter;
use Illuminate\Http\Request;
use DB;
use Auth;

class autorizacionMantenimientoController extends Controller
{
    public function index(){
        //
        $autorizaciones = seguimientoMantenimiento::with('citas_mantenimiento','citas_mantenimiento.unidad','citas_mantenimiento.asignacion_unidad',
        'citas_mantenimiento.asignacion_unidad.cliente')->where('autorizacion',2)->get();
        //dd($autorizaciones);
        return view('administracion.autorizacionesMantenimiento.index')
        ->with('autorizaciones',$autorizaciones);
    }

    public function show($id_cita_mantenimiento){
        //dd($id_cita_mantenimiento);
        $info_mantenimiento = MantenimientoCallCenter::with('asignacion_unidad.cliente','asignacion_unidad.responsable','unidad.tipo_unidad','poliza','poliza.polizas',
        'unidad.marca','poliza.gps','poliza.aseguradora','proveedor')
        ->where('id_citas_mantenimiento', $id_cita_mantenimiento)->get();
        $autorizacion = seguimientoMantenimiento::with('citas_mantenimiento','citas_mantenimiento.unidad','citas_mantenimiento.asignacion_unidad',
        'citas_mantenimiento.asignacion_unidad.cliente')
        ->where('id_citas_mantenimiento', $id_cita_mantenimiento)->get();
        //dd($info_mantenimiento);
        return view('administracion.autorizacionesMantenimiento.show')
        ->with('autorizacion',$autorizacion)
        ->with('info_mantenimiento',$info_mantenimiento);
    }

    public function update(Request $request){
        // dd($request->all());
        $id_cita_mantenimiento = $request->id_cita_mantenimiento;
        $tipo_autorizacion = $request->autorizar;
        $id_user = Auth::user()->id;
        $name_user = Auth::user()->name;
        if ($tipo_autorizacion == 1) {
            # code...
            $update_seguimiento = DB::table('seguimiento_mantenimiento')
            ->where('id_citas_mantenimiento', $id_cita_mantenimiento)
            ->update([
                'observaciones_flising' => $request->observaciones_flising,
                'fecha_respuesta' => date('Y-m-d'),
                'status_autorizacion' => 3,
                'id_user' => $id_user,
                'nombre_user' => $name_user
            ]);
            $update_cita = DB::table('citas_mantenimiento')
            ->where('id_citas_mantenimiento', $id_cita_mantenimiento)
            ->update([
                'estado' => 'RECHAZADO'
            ]);
        } else {
            $update_seguimiento = DB::table('seguimiento_mantenimiento')
            ->where('id_citas_mantenimiento', $id_cita_mantenimiento)
            ->update([
                'observaciones_flising' => $request->observaciones_flising,
                'fecha_respuesta' => date('Y-m-d'),
                'status_autorizacion' => 2,
                'id_user' => $id_user,
                'nombre_user' => $name_user
            ]);
            $update_cita = DB::table('citas_mantenimiento')
            ->where('id_citas_mantenimiento', $id_cita_mantenimiento)
            ->update([
                'estado' => 'AUTORIZADO'
            ]);
        }
        return redirect('administracion/mantenimientos/autorizacion/index')->with('success','Solicitud de mantenimiento actualizada con éxito.');
    }

    public function showRechazado($id_cita_mantenimiento){
        $info_mantenimiento = MantenimientoCallCenter::with('asignacion_unidad.cliente','asignacion_unidad.responsable','unidad.tipo_unidad','poliza','poliza.polizas',
        'unidad.marca','poliza.gps','poliza.aseguradora','proveedor')
        ->where('id_citas_mantenimiento', $id_cita_mantenimiento)->get();
        $autorizacion = seguimientoMantenimiento::with('citas_mantenimiento','citas_mantenimiento.unidad','citas_mantenimiento.asignacion_unidad',
        'citas_mantenimiento.asignacion_unidad.cliente')
        ->where('id_citas_mantenimiento', $id_cita_mantenimiento)->get();
        return view('administracion.autorizacionesMantenimiento.rechazado')
        ->with('autorizacion',$autorizacion)
        ->with('info_mantenimiento',$info_mantenimiento);
    }

    public function showAutorizado($id_cita_mantenimiento){
        $info_mantenimiento = MantenimientoCallCenter::with('asignacion_unidad.cliente','asignacion_unidad.responsable','unidad.tipo_unidad','poliza','poliza.polizas',
        'unidad.marca','poliza.gps','poliza.aseguradora','proveedor')
        ->where('id_citas_mantenimiento', $id_cita_mantenimiento)->get();
        $autorizacion = seguimientoMantenimiento::with('citas_mantenimiento','citas_mantenimiento.unidad','citas_mantenimiento.asignacion_unidad',
        'citas_mantenimiento.asignacion_unidad.cliente')
        ->where('id_citas_mantenimiento', $id_cita_mantenimiento)->get();
        return view('administracion.autorizacionesMantenimiento.autorizado')
        ->with('autorizacion',$autorizacion)
        ->with('info_mantenimiento',$info_mantenimiento);
    }
}
