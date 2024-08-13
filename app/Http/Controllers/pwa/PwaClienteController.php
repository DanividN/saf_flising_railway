<?php

namespace App\Http\Controllers\pwa;

use App\Http\Controllers\Controller;
use App\Http\Requests\pwa\CrearValidacionRequest;
use App\Models\administracion\CitaSupervision;
use App\Models\administracion\Supervision;
use App\Models\configuracion\cliente;
use App\Models\configuracion\unidad;
use App\Models\funciones\citaVerificacion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PwaClienteController extends Controller {
    private $meses = [
        'enero' => 1,
        'febrero' => 2,
        'marzo' => 3,
        'abril' => 4,
        'mayo' => 5,
        'junio' => 6,
        'julio' => 7,
        'agosto' => 8,
        'septiembre' => 9,
        'octubre' => 10,
        'noviembre' => 11,
        'diciembre' => 12,
    ];
    
    public function index(Request $request) {
        $idClientes = CitaSupervision::where('id_usuario', Auth::id())->pluck('id_cliente')->toArray();
        $clientes = cliente::with('responsables')->where('activo', 1)->whereIn('id_cliente', $idClientes)->get();
        return view('pwa.views.clientes.clientes')->with(compact('clientes'));
    }

    public function searchClientes(Request $request) {
        $search = $request->input('search');
        $clientes = cliente::with('responsables')
            ->where('activo', 1)
            ->where('id_usuario', Auth::id())
            ->when($search, function ($query, $search) {
                return $query->where('nombre_cliente', 'like', "%{$search}%")
                    ->orWhere('nombre_representante', 'like', "%{$search}%");
            })
            ->get();

        return view('pwa.views.clientes.listadoClientes')->with(compact('clientes'));
    }

    public function unidadesCliente($id_cliente) {
        $citas = CitaSupervision::with('cliente', 'supervisor', 'unidad.tipo_unidad', 'unidad.marca')
            ->where('id_cliente', $id_cliente)
            ->where('id_usuario', Auth::id())
            ->where('fecha_supervision', '>=', Carbon::now()->subDays(5))
            ->where('notificacion_citas', '!=', CitaSupervision::VALIDADA)
            ->get();

        $cliente = cliente::find($id_cliente);
        return view('pwa.views.unidades.unidadesCliente')->with(compact('citas', 'cliente'));
    }

    public function unidadesClienteSearch(Request $request, $id_cliente) {
        $search = $request->input('search');
        $citas = CitaSupervision::with('cliente', 'supervisor', 'unidad.tipo_unidad', 'unidad.marca')
            ->where('id_cliente', $id_cliente)
            ->where('id_usuario', Auth::id())
            ->where('notificacion_citas', '!=', CitaSupervision::VALIDADA)
            ->where('fecha_supervision', '>=', Carbon::now()->subDays(5))
            ->when($search, function ($query, $search) {
                return $query->whereHas('unidad', function ($query) use ($search) {
                    $query->where('modelo', 'like', "%{$search}%")
                        ->orWhere('vehiculo_id', 'like', "%{$search}%")
                        ->orWhereHas('marca', function ($query) use ($search) {
                            $query->where('descripcion', 'like', "%{$search}%");
                        });
                });
            })->get();

        return view('pwa.views.unidades.listadoUnidades')->with(compact('citas'));
    }

    public function agregarValidacionUnidad(CitaSupervision $cita) {
        try {
            DB::beginTransaction();
                $cita->load('cliente', 'supervisor', 'unidad.tipo_unidad', 'asignacionUnidad', 'unidad.marca');

                $notificacion = CitaSupervision::find($cita->id_citas_supervision);
                $notificacion->mostrar_notificacion = '0';
                $notificacion->save();

                $verificaciones = $this->obteberDatosDeVerificacion($cita);
            DB::commit();

            return view('pwa.views.unidades.agregarValidacionUnidad')->with(compact('cita', 'verificaciones'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withInput()->withErrors('error', 'Ocurrió intentalo de nuevo');
        }
    }

    public function obteberDatosDeVerificacion($cita) {
        $unidad = unidad::find($cita->id_unidad);
        $mesActual = intval(date('n'));
        $añoActual = date('Y');
        $actualDate = Carbon::now();

        if (!$cita->asignacionUnidad->primer_semestre && !$cita->asignacionUnidad->segundo_semestre) {
            return [ 'primer_periodo' => 'PENDIENTE', 'segundo_periodo' => 'PENDIENTE' ];
        }
    
        $primerSemestre = explode(' - ', $cita->asignacionUnidad->primer_semestre);
        $segundoSemestre = explode(' y ', $cita->asignacionUnidad->segundo_semestre);
    
        $fechasPrimerPeriodo = [
            0 => Carbon::create($añoActual, $this->meses[$primerSemestre[0]], 1),
            1 => Carbon::create($añoActual, $this->meses[$primerSemestre[1]])->endOfMonth(),
        ];
    
        $fechasSegundoPeriodo = [
            0 => Carbon::create($añoActual, $this->meses[$segundoSemestre[0]], 1),
            1 => Carbon::create($añoActual, $this->meses[$segundoSemestre[1]])->endOfMonth(),
        ];
    
        $holograma = explode(' ', $unidad->UltimaVerificacion->Seguimiento->Holograma->tiempo ?? ' ');
        $fechaHolograma = Carbon::parse($unidad->UltimaVerificacion->Seguimiento->fecha_verificacion ?? null)->addYears(intval($holograma[0]));
    
        $estadoPrimerPeriodo = $this->obtenerEstadoPeriodo($unidad, $fechasPrimerPeriodo, $fechaHolograma, 'PRIMER PERIODO', $actualDate, $holograma);
        $estadoSegundoPeriodo = $this->obtenerEstadoPeriodo($unidad, $fechasSegundoPeriodo, $fechaHolograma, 'SEGUNDO PERIODO', $actualDate, $holograma);
    
        return [ 'primer_periodo' => $estadoPrimerPeriodo, 'segundo_periodo' => $estadoSegundoPeriodo ];
    }
    
    private function obtenerEstadoPeriodo($unidad, $fechas, $fechaHolograma, $periodo, $actualDate, $holograma) {
        if (($unidad->UltimaVerificacion->estado ?? '') == 'CONCLUIDO' && $unidad->UltimaVerificacion->Seguimiento->periodo == $periodo)
            $givenDate = Carbon::parse($unidad->UltimaVerificacion->fecha_hora_verificacion ?? 0);
        else $givenDate = Carbon::parse(0);
    
        if ($givenDate->between($fechas[0], $fechas[1]))
            return 'CONCLUIDO';
        else if ($holograma[1] == 'años' && $actualDate->lt($fechaHolograma))
            return 'VIGENTE';
        else if ($actualDate->between($fechas[0], $fechas[1]))
            return 'PENDIENTE';
        else if ($actualDate->lt($fechas[0]))
            return 'VIGENTE';
        else
            return 'VENCIDO';
    }

    public function crearValidacion(CrearValidacionRequest $request, CitaSupervision $citaSupervision) {
        try {
            DB::beginTransaction();
                $citaSupervision->load('asignacionUnidad', 'unidad.marca');

                $citaSupervision->notificacion_citas = CitaSupervision::CONCLUIDA;
                $citaSupervision->mostrar_notificacion = '1';
                $citaSupervision->notificacion_web = '1';
                $citaSupervision->save();

                $supervision = new Supervision();
                $supervision->id_citas_supervision = $citaSupervision->id_citas_supervision;
                $supervision->talon_verificacion = $request->talon_verificacion ?? 0;
                $supervision->llave_repuesto = $request->llave_repuesto ?? 0;
                $supervision->gato_hidraulico = $request->gato_hidraulico ?? 0;
                $supervision->triangulo_seguridad = $request->triangulo_seguridad ?? 0;
                $supervision->manual_usuario = $request->manual_usuario ?? 0;
                $supervision->engomado = $request->engomado ?? 0;
                $supervision->placas_check = $request->placas_check ?? 0;
                $supervision->poliza_mantenimiento = $request->poliza_mantenimiento ?? 0;
                $supervision->llanta_refaccion = $request->llanta_refaccion ?? 0;
                $supervision->poliza_seguro = $request->poliza_seguro ?? 0;
                $supervision->tarjeta_circulacion = $request->tarjeta_circulacion ?? 0;
                $supervision->vida_util_llantas = $request->vida_util_llantas;
                $supervision->observacion_supervisor = $request->observacion_supervisor;
                $supervision->obsevaciones_vista_frontal = $request->obsevaciones_vista_frontal;
                $supervision->obsevaciones_vista_izquierda = $request->obsevaciones_vista_izquierda;
                $supervision->obsevaciones_vista_trasera = $request->obsevaciones_vista_trasera;
                $supervision->obsevaciones_vista_derecha = $request->obsevaciones_vista_derecha;

                $imagenBase64 = $request->canvas;
                if (preg_match('/^data:image\/(\w+);base64,/', $imagenBase64, $type)) {
                    $imagenBase64 = substr($imagenBase64, strpos($imagenBase64, ',') + 1);
                    $type = strtolower($type[1]); // jpg, png, gif
        
                    $imagenDecodificada = base64_decode($imagenBase64);
                    if (!$imagenDecodificada) throw new \Exception('Decoding failed');

                    $nombreSupervisor = str_replace(' ', '', $citaSupervision->supervisor->name) . '_' . time();
                    $nombreArchivo = "{$citaSupervision->id_citas_supervision}_{$nombreSupervisor}.{$type}";
                    $rutaArchivo = "firmasElectronica/{$nombreArchivo}";
                    $supervision->img_firma_cliente = $rutaArchivo;
                    
                    $directory = public_path('storage/firmasElectronica');
                    
                    if (!Storage::exists('public/firmasElectronica')) {
                        Storage::makeDirectory('public/firmasElectronica');
                        chmod($directory, 0755);
                    }

                    Storage::disk('public')->put($rutaArchivo, $imagenDecodificada);
                } else {
                    throw new \Exception('No se pudo guardar la imagen de la firma');
                }

                $nomenclatura = $citaSupervision->asignacionUnidad->placas . '_' . $citaSupervision->id_citas_supervision;
                $supervision->img_izquierda = $this->guardarImagenDesdeBase64($request->pills_izquierda_superior_img, $nomenclatura . '_izquierda');
                $supervision->img_trasera = $this->guardarImagenDesdeBase64($request->pills_trasera_superior_img, $nomenclatura . '_trasera');
                $supervision->img_derecha = $this->guardarImagenDesdeBase64($request->pills_derecha_superior_img, $nomenclatura . '_derecha');
                $supervision->img_frontal = $this->guardarImagenDesdeBase64($request->pills_frontal_superior_img, $nomenclatura . '_frontal');

                $supervision->evidecia_vista_frontal = $this->uploadFile($request->evidecia_vista_frontal, $nomenclatura . '_evidencia_frontal');
                $supervision->evidecia_vista_izquierda = $this->uploadFile($request->evidecia_vista_izquierda, $nomenclatura . '_evidencia_izquierda');
                $supervision->evidecia_vista_trasera = $this->uploadFile($request->evidecia_vista_trasera, $nomenclatura . '_evidencia_trasera');
                $supervision->evidecia_vista_derecha = $this->uploadFile($request->evidecia_vista_derecha, $nomenclatura . '_evidencia_derecha');
                $supervision->save();
            DB::commit();

            return redirect()->route('pwa.clientes.unidades', $citaSupervision->id_cliente)->with('success', 'Se ha guardado la validación correctamente');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function guardarImagenDesdeBase64($imagenBase64, $nomenclatura) {
        if (preg_match('/^data:image\/(\w+);base64,/', $imagenBase64, $type)) {
            $imagenBase64 = substr($imagenBase64, strpos($imagenBase64, ',') + 1);
            $type = strtolower($type[1]); // jpg, png, gif

            $imagenDecodificada = base64_decode($imagenBase64);
            if (!$imagenDecodificada) throw new \Exception('Decoding failed');

            $nombreArchivo = $nomenclatura . '_' . time() . ".{$type}";
            $rutaArchivo = "evidenciasSupervision/{$nombreArchivo}";

            $directory = public_path('storage/evidenciasSupervision');
            if (!Storage::exists('public/evidenciasSupervision')) {
                Storage::makeDirectory('public/evidenciasSupervision');
                chmod($directory, 0755);
            } 

            Storage::disk('public')->put($rutaArchivo, $imagenDecodificada);

            return $rutaArchivo;
        } else {
            throw new \Exception('No se pudo guardar la imagen de la evidencia');
        }
    }

    public function uploadFile($file, $nomenclatura) {
        if (!$file) throw new \Exception("No se proporcionó un archivo válido.");
    
        $file_name = $nomenclatura . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = 'evidenciasSupervision/' . $file_name;
        $directory = public_path('storage/evidenciasSupervision');

        if (!Storage::exists('public/evidenciasSupervision')) {
            Storage::makeDirectory('public/evidenciasSupervision');
            chmod($directory, 0755);
        } 
    
        try {
            Storage::disk('public')->put($path, file_get_contents($file));
        } catch (\Exception $e) {
            throw new \Exception("Error al guardar el archivo: " . $e->getMessage());
        }
    
        return $path;
    }

    public function mostrarValidacionUnidad($id_citas_supervision) {
        try {
            DB::beginTransaction();
                $cita = CitaSupervision::with('cliente', 'supervisor', 'unidad.tipo_unidad', 'asignacionUnidad', 'unidad.marca', 'supervision')->find($id_citas_supervision);

                $notificacion = CitaSupervision::find($id_citas_supervision);
                $notificacion->mostrar_notificacion = '0';
                $notificacion->save();

                $verificaciones = $this->obteberDatosDeVerificacion($cita);
            DB::commit();

            return view('pwa.views.unidades.showValidacion')->with(compact('cita', 'verificaciones'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withInput()->withErrors('error', 'Ocurrió intentalo de nuevo');
        }
    }

    public function notificacionesCitas() {
        $citas = CitaSupervision::with('cliente', 'supervisor', 'unidad.tipo_unidad', 'asignacionUnidad', 'unidad.marca')
            ->where('mostrar_notificacion', '1')
            ->where('id_usuario', Auth::id())
            ->get();
        
        return view('pwa.views.notificaciones')->with(compact('citas'));
    }
}