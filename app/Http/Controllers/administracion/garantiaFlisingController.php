<?php

namespace App\Http\Controllers\administracion;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\configuracion\unidad;
use App\Models\administracion\unidadGarantia;
use App\Models\configuracion\garantia\garantiaFlisingExtendida;
use Illuminate\Support\Facades\DB;


class garantiaFlisingController extends Controller
{
    public function index()
    {
        $unidades = unidad::whereIn('id_estado', [1, 2])
            ->where('activo', 1)
            ->select('id_unidad', 'vehiculo_id', 'activo')
            ->orderBy('vehiculo_id','asc')
            ->get();
        
        $garantiasDisponibles = garantiaFlisingExtendida::where('activo', 1)
        ->orderBy('nombre_g_extendida', 'asc')
        ->get();
        $count = 1;
    
        // Consulta original
        $unidadConGarantia = unidadGarantia::with('unidad.tipo_unidad', 'unidad.marca')
            ->select('id_unidad', 'tipo')
            ->where('tipo', 'GARANTIAS EXTENDIDAS FLISING')
            ->whereNotNull('id_unidad')
            ->distinct()
            ->get();

        return view('administracion.garantiasFlising.index', [
            'garantiasDisponibles' => $garantiasDisponibles,
            'count' => $count,
            'unidades' => $unidades,
            'unidadConGarantia' => $unidadConGarantia
        ]);
    }
    


    public function store(Request $request)
    {
        $selectedGarantias = json_decode($request->input('selected_garantias'), true);
        // dd($selectedGarantias);
        
        // Asegúrate de que el arreglo no sea null antes de usarlo
        if (is_null($selectedGarantias)) {
            return redirect()->back()->with('error', 'Datos incompletos proporcionados.');
        }
        
        foreach ($selectedGarantias as $garantia) {
            $fechaInicial = $garantia['fecha_inicial'];
            $vigencia = $garantia['vigencia'];
            
            if ($fechaInicial && $vigencia) {
                // Asegúrate de que la fecha inicial y la vigencia sean válidas
                try {
                    $fechaInicial = Carbon::parse($fechaInicial);
                    $vigenciaMeses = (int) filter_var($vigencia, FILTER_SANITIZE_NUMBER_INT);
                    $fechaFinal = (clone $fechaInicial)->addMonths($vigenciaMeses);
                    
                    unidadGarantia::create([
                        'id_unidad' => $request->input('hidden_id_unidad'),
                        'id_garantia_proveedor' => $garantia['id_g_flising_extendidas'],
                        'id_asignacion_unidad' => $request->input('hidden_id_asignacion_unidad'),
                        'tipo' => 'GARANTIAS EXTENDIDAS FLISING',
                        'fecha_inicial' => $fechaInicial->format('Y-m-d'),
                        'fecha_final' => $fechaFinal->format('Y-m-d'),
                        'evento_asignado' => 0,
                        'status' => 1
                    ]);
                } catch (\Exception $e) {
                    // Manejo de excepciones en caso de error al parsear la fecha
                    return redirect()->back()->with('error', 'Error al procesar la fecha: ' . $e->getMessage());
                }
            }
        }
    
        return redirect()->back()->with('success', 'Agregado exitosamente.');
    }
    
    public function show(unidad $garantias_flising){
        
        $garantiasDisponibles = garantiaFlisingExtendida::where('activo', 1)
        ->orderBy('nombre_g_extendida', 'asc')
        ->get();

        $unidades = unidad::whereIn('id_estado',[1,2] )
        ->where('activo',1)
        ->select('id_unidad','vehiculo_id','activo')->get();
        
        $garantias_flising->UltimoArrendamiento = $garantias_flising->UltimoArrendamiento()->with('Responsable','Cliente','Unidad_garantias')->first();
        
        $garantiasSeleccionadas = unidadGarantia::with('unidad','garantiasFlising')
        ->where('tipo', 'GARANTIAS EXTENDIDAS FLISING')
        ->where('id_unidad', $garantias_flising->UltimoArrendamiento->id_unidad)
        // ->where(DB::raw('YEAR(fecha_inicial)'), date('Y'))
        ->orderBy('fecha_inicial', 'desc')
        ->get();
        
        /**Year actual */
        // $garantiasSeleccionadasYear = unidadGarantia::with('unidad','garantiasFlising')
        // ->where('tipo', 'GARANTIAS EXTENDIDAS FLISING')
        // ->where('id_unidad', $garantias_flising->UltimoArrendamiento->id_unidad)
        // ->where(DB::raw('YEAR(fecha_inicial)'), date('Y'))
        // ->get();
        
        $e = 1;
        // dd( $garantiasSeleccionadas);
        return view('administracion.garantiasFlising.informacion',[
            'garantias_flising' => $garantias_flising,
            'garantiasSeleccionadas' => $garantiasSeleccionadas,
            'e' => $e,
            'garantiasDisponibles' => $garantiasDisponibles,
            'unidades' => $unidades,
            // 'garantiasSeleccionadasYear' => $garantiasSeleccionadasYear
        ]);
    }

    
    public function update(Request $request)
    {
       
        $garantiasSeleccionadas = unidadGarantia::where('tipo', 'GARANTIAS EXTENDIDAS FLISING')
        ->where('id_unidad', $request->hidden_id_unidad)
        ->where(DB::raw('YEAR(fecha_inicial)'), date('Y'))
        ->pluck('id_garantia_proveedor')
        ->toArray();

        $idsArray1 =json_decode($request->garantia_extendida_base, true);
        
        $idsArray2 = $garantiasSeleccionadas;
        
        
        $onlyInArray2 = array_diff($idsArray2, $idsArray1);
        
        $selectedGarantias = json_decode($request->input('selected_garantias'), true);
        
        if (count($selectedGarantias) == 0 && count($onlyInArray2)==0) {
            return redirect()->back()->with('error', 'Datos incompletos proporcionados.');
        }
       
        
        foreach($onlyInArray2 as $eliminados){
            
            // DB::table('unidad_garantias')
            // ->where('tipo', 'GARANTIAS EXTENDIDAS FLISING')
            // ->where('id_unidad', $request->hidden_id_unidad)
            // ->where('id_garantia_proveedor', $eliminados)
            // ->delete();
            
            DB::table('unidad_garantias')
            ->where('tipo', 'GARANTIAS EXTENDIDAS FLISING')
            ->where('id_unidad', $request->hidden_id_unidad)
            ->where('id_garantia_proveedor', $eliminados)
            ->update(['status' => 0]);
        }
        
        // dd($selectedGarantias);
        
        if (is_null($selectedGarantias)) {
            return redirect()->back()->with('error', 'Datos incompletos proporcionados.');
        }
     
        // Obtén los valores de los campos ocultos
        $id_unidad = $request->input('hidden_id_unidad');
        $id_asignacion_unidad = $request->input('hidden_id_asignacion_unidad');
        
        if (empty($id_unidad) || empty($id_asignacion_unidad)) {
            return redirect()->back()->with('error', 'ID de unidad o asignación no proporcionado.');
        }

        //     // dd($garantia);
        // foreach ($selectedGarantias as $garantia) {
        //     if (isset($garantia['id_g_flising_extendidas']) && isset($garantia['fecha_inicial']) && isset($garantia['vigencia'])) {
        //         $fechaInicial = $garantia['fecha_inicial'];
        //         $vigencia = $garantia['vigencia'];
                
        //         if ($fechaInicial && $vigencia) {
                    
        //             try {
        //                 $fechaInicial = Carbon::parse($fechaInicial);
        //                 $vigenciaMeses = (int) filter_var($vigencia, FILTER_SANITIZE_NUMBER_INT);
        //                 $fechaFinal = (clone $fechaInicial)->addMonths($vigenciaMeses);
        //                 $eventos = $request->evento_asignado ?? 0;

        //                 DB::table('unidad_garantias')->updateOrInsert(
        //                     [
        //                         'id_garantia_proveedor' => $garantia['id_g_flising_extendidas'],
        //                         'id_unidad' => $id_unidad,
        //                         'id_asignacion_unidad' => $id_asignacion_unidad,
        //                         'tipo' => 'GARANTIAS EXTENDIDAS FLISING',
                            
        //                     ],
        //                     [
        //                         'fecha_inicial' => $fechaInicial->format('Y-m-d'),
        //                         'fecha_final' => $fechaFinal->format('Y-m-d'),
        //                         'tipo' => 'GARANTIAS EXTENDIDAS FLISING',

        //                     ]
        //                 );

        //             } catch (\Exception $e) {
        //                 // Manejo de excepciones en caso de error al parsear la fecha
        //                 return redirect()->back()->with('error', 'Error al procesar la fecha: ' . $e->getMessage());
        //             }
        //         }
        //     }
        // }
        foreach ($selectedGarantias as $garantia) {
            if (isset($garantia['id_g_flising_extendidas']) && isset($garantia['fecha_inicial']) && isset($garantia['vigencia'])) {

                $fechaInicial = $garantia['fecha_inicial'];
                $vigencia = $garantia['vigencia'];
                
                if ($fechaInicial && $vigencia) {
                    try {
                        $fechaInicial = Carbon::parse($fechaInicial);
                        $vigenciaMeses = (int) filter_var($vigencia, FILTER_SANITIZE_NUMBER_INT);
                        $fechaFinal = (clone $fechaInicial)->addMonths($vigenciaMeses);
                        
                        // Verifica si ya existe un registro con el mismo id_unidad_garantia
                        // dd('hola');
                        $unidadGarantia = DB::table('unidad_garantias')
                        ->where('id_unidad_garantia', $garantia['id_unidad_garantia'] ?? 0)
                        ->first();
                       
                        
                        if ($unidadGarantia) {
                            // Actualiza la fecha final si el registro ya existe
                            DB::table('unidad_garantias')
                                ->where('id_unidad_garantia', $garantia['id_unidad_garantia'])
                                ->update([
                                    'fecha_inicial' => $fechaInicial->format('Y-m-d'),
                                    'fecha_final' => $fechaFinal->format('Y-m-d'),
                                    'tipo' => 'GARANTIAS EXTENDIDAS FLISING',
                                ]);
                        } else {
                            // Inserta un nuevo registro si no existe
                            DB::table('unidad_garantias')->insert([
                                'id_garantia_proveedor' => $garantia['id_g_flising_extendidas'],
                                'id_unidad' => $id_unidad,
                                'id_asignacion_unidad' => $id_asignacion_unidad,
                                'fecha_inicial' => $fechaInicial->format('Y-m-d'),
                                'fecha_final' => $fechaFinal->format('Y-m-d'),
                                'tipo' => 'GARANTIAS EXTENDIDAS FLISING',
                                'status' => 1
                            ]);
                        }
                    } catch (\Exception $e) {
                        // Manejo de excepciones en caso de error al parsear la fecha
                        return redirect()->back()->with('error', 'Error al procesar la fecha: ' . $e->getMessage());
                    }
                }
            }
        }

        // Redirige al usuario con un mensaje de éxito
        return redirect()->back()->with('success', 'Registro actualizado correctamente.');
    }
    
    

    public function unidadCliente(unidad $unidad)
    {
        $asignaciones = $unidad->UltimoArrendamiento()->with('Cliente')->first();
        return response()->json($asignaciones);
    }
    public function obtenerGarantias(unidad $unidad)
    {
        $unidadesAgregadas = unidadGarantia::select('id_unidad_garantia','id_garantia_proveedor','evento_asignado','fecha_inicial', 'fecha_final')
        ->where('tipo', 'GARANTIAS EXTENDIDAS FLISING')
        ->where('id_unidad', $unidad->id_unidad)
        ->where(DB::raw('YEAR(fecha_inicial)'), date('Y'))
        ->whereNotNull('id_unidad')
        ->get();

        // dd($unidadesAgregadas);
        return response()->json($unidadesAgregadas);
    }


}
