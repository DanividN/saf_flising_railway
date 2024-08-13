<?php

namespace App\Http\Controllers\funciones;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\configuracion\unidad;
use Illuminate\Support\Facades\Auth;
use App\Models\administracion\unidadGarantia;
use App\Models\configuracion\garantia\garantiaFlisingExtendida;
use App\Models\funciones\callCenter;

class garantiaCallCenterController extends Controller
{
    public function index()
    {

        $unidadConGarantia = unidadGarantia::with('unidad.tipo_unidad', 'unidad.marca','arrendamiento','arrendamiento.Responsable')
            ->select(
                'id_unidad', 
                'tipo',
                'id_asignacion_unidad'
            )
            ->whereHas('arrendamiento', function($q){
                $q->whereIn('id_cliente',Auth::user()->usuarioClientes->pluck('id_cliente'));
            })
            ->whereHas('arrendamiento.Responsable', function($q){
                $q->where('vip', Auth::user()->vip);
            })
            ->where('tipo', 'GARANTIAS EXTENDIDAS FLISING')
            ->whereNotNull('id_unidad')
            ->distinct()
            ->get();
        return view('funciones.garantiasFlising.index', [
            'unidadConGarantia' => $unidadConGarantia
        ]);
    }
    public function store(Request $request){
       
        $evento_inicial = intval( $request->evento_inical);
        $actualizar_evento = intval($request->siguiente_evento);
        
        $busqueda = DB::table('unidad_garantias')
        ->where('id_unidad_garantia', $request->id_unidad_garantia)
        ->first();

        if($busqueda){
            if($actualizar_evento < $evento_inicial){
                $actualizar_evento++;
    
                DB::table('unidad_garantias')
                ->where('id_unidad_garantia',$request->id_unidad_garantia)
                ->where('id_unidad',$request->id_unidad)
                ->where('id_garantia_proveedor',$request->id_proveedor)
                ->where('id_asignacion_unidad',$request->id_asignacion_unidad)
                ->update(['evento_asignado' => $actualizar_evento]);
    
            }else{
                return redirect()->back()->with('error','Liminte de garantías excedido');
            }
        }

        

        return redirect()->back()->with('success','Garantía aplicada exitosamente');
    }
    public function show(unidad $garantias_callCenter){
        
       
        /**Datos para modal de call center */
        $horaActual = Carbon::now('America/Mexico_City')->format('H:i A');
        $horaActual = str_replace('24', '00', $horaActual); // Reemplazar '24' por '00' para evitar mostrar '24:xx PM'
        $fechaActual = Carbon::now()->format('d/m/Y');
    
        
        $garantiasSeleccionadas = unidadGarantia::with('unidad','garantiasFlising')
        ->where('tipo', 'GARANTIAS EXTENDIDAS FLISING')
        ->where('id_unidad', $garantias_callCenter->UltimoArrendamiento->id_unidad)
        ->orderBy('fecha_inicial', 'desc')
        ->get();


        return view('funciones.garantiasFlising.informacion',[
            'garantia' => $garantias_callCenter,
            'garantiasSeleccionadas' => $garantiasSeleccionadas,
            'horaActual' => $horaActual,
            'fechaActual' => $fechaActual
        ]);
    }
    
    public function altaRegistroAtencion(Request $request){
        $horaActual = Carbon::now('America/Mexico_City')->format('H:i A');
        $horaActual = str_replace('24', '00', $horaActual); // Reemplazar '24' por '00' para evitar mostrar '24:xx PM'
        $fechaActual = Carbon::now();
        $request->validate([
            'estatus' => 'required',
            'descripcion' => 'required'
        ]);

        $datos = [
            'modulo' => '5',
            'id_asignacion_unidad' => $request->id_asignacion_unidad,
            'estatus' => $request->estatus,
            // 'tipo_llamada' => $request->estatus,
            'fecha' => $fechaActual,
            'hora' => $horaActual,
            'id_callcenter' => Auth::user()->id,
            'descripcion' => $request->descripcion,
        ];

        callCenter::create($datos);

        return redirect()->back()->with('success', 'Registro se a guardado correctamente.');
    }
}
