<?php

namespace App\Http\Controllers\administracion;

use App\Exports\InformeSupervisionExport;
use App\Exports\InformeSupervisionPorUnidad;
use App\Http\Controllers\Controller;
use App\Models\administracion\asignacionUnidad;
use App\Models\administracion\CitaSupervision;
use App\Models\configuracion\cliente;
use App\Models\configuracion\unidad;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class SupervisionController extends Controller
{
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

    public function index() {
        $clientes = cliente::with('activos')->where('activo', 1)->get();
        $supervisores = User::where('tipo_usuario', User::SUPERVISIONAPP)->get();

        return view('administracion.supervision.index')->with(compact('clientes', 'supervisores'));
    }

    public function unidadesArrendadas($id_cliente) {
        $unidadesAgendadas = CitaSupervision::where('notificacion_citas', CitaSupervision::AGENDADA)
            ->orWhere('notificacion_citas', CitaSupervision::VENCIDA)
            ->where('id_cliente', $id_cliente)
            ->pluck('id_unidad')
            ->toArray();
        $unidadesArrendadas = asignacionUnidad::with('Unidad', 'Responsable')->where('id_cliente', $id_cliente)->where('activo', 1)->whereNotIn('id_unidad', $unidadesAgendadas)->get();

        return response()->json($unidadesArrendadas);
    }

    public function agendarCitaSupervision(Request $request) {
        try {
            DB::beginTransaction();
                if ($request->unidadesSeleccionadas == null) throw new Exception('No se seleccionaron unidades para agendar la cita.');

                foreach($request->unidadesSeleccionadas as $unidad) {
                    $ultimoArrendamiento = asignacionUnidad::where('id_unidad', $unidad)->where('activo', 1)->first()->id_asignacion_unidad;
                    
                    $cita = new CitaSupervision();
                    $cita->id_asignacion_unidad = $ultimoArrendamiento;
                    $cita->id_cliente = $request->id_cliente;
                    $cita->id_usuario = $request->id_usuario;
                    $cita->id_unidad = $unidad;
                    $cita->fecha_supervision = Carbon::parse(str_replace('/', '-', $request->fecha_supervision))->format('Y-m-d');
                    $cita->hora = $request->hora;
                    $cita->mostrar_notificacion = '1';
                    $cita->notificacion_web = '1';
                    $cita->save();
                }
            DB::commit();

            return back()->with('success', 'Citas agendadas correctamente');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Ocurrió un error al agendar las citas(Selecciona al menos una unidad). Inténtalo de nuevo.');
        }
    }
    
    public function listaUnidadesAgendadas($id_cliente) {
        $cliente = cliente::find($id_cliente);
        $unidadesAgendadas = CitaSupervision::with('unidad.tipo_unidad', 'asignacionUnidad.Responsable', 'supervisor', 'cliente')
            ->where('id_cliente', $id_cliente)
            ->get()
            ->groupBy('id_unidad')
            ->map(function ($citas) {
                return $citas->sortByDesc('id_citas_supervision')->first();
            });
            
        return view('administracion.supervision.listaUnidades')->with(compact('unidadesAgendadas', 'cliente'));
    }

    public function historialCitas($id_cliente, $id_unidad) {
        $citas = CitaSupervision::with('unidad.tipo_unidad', 'asignacionUnidad.Responsable', 'supervisor', 'cliente')
            ->where('id_unidad', $id_unidad)
            ->where('id_cliente', $id_cliente)
            ->get();

        return view('administracion.supervision.informacion')->with(compact('citas'));
    }

    public function mostrarValidacionUnidad($id_citas_supervision) {
        $cita = CitaSupervision::with('cliente', 'supervisor', 'unidad.tipo_unidad', 'asignacionUnidad', 'unidad.marca', 'supervision')->find($id_citas_supervision);
        $verificaciones = $this->obteberDatosDeVerificacion($cita);

        return view('administracion.supervision.showValidacion')->with(compact('cita', 'verificaciones'));
    }

    public function validarSupervision($id_citas_supervision) {
        try {
            DB::beginTransaction();
                $cita = CitaSupervision::with('cliente', 'supervisor', 'unidad.tipo_unidad', 'asignacionUnidad', 'unidad.marca', 'supervision')->find($id_citas_supervision);
                $cita->notificacion_web = '0';
                $cita->save();

                $verificaciones = $this->obteberDatosDeVerificacion($cita);
            DB::commit();
            return view('administracion.supervision.agregarValidacion')->with(compact('cita', 'verificaciones'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Ocurrió un error. Inténtalo de nuevo.');
        }
        
    }

    public function cancelarCita(Request $request, $id_citas_supervision) {
        try {
            DB::beginTransaction();
                $cita = CitaSupervision::with('cliente', 'supervisor', 'unidad.tipo_unidad', 'asignacionUnidad', 'unidad.marca', 'supervision')->find($id_citas_supervision);
                $cita->notificacion_citas = $request->notificacion_citas;
                $cita->mostrar_notificacion = '1';
                $cita->observacion_flising = $request->observacion_flising;
                $cita->save();
            DB::commit();

            return redirect()->route('supervision.mostrar.validacion', $cita->id_citas_supervision)->with('success', 'Cita valida correctamente');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Ocurrió un error al cancelar la cita. Inténtalo de nuevo.');
        }
    }

    public function informeSupervision() {
        $clientes = cliente::pluck('nombre_cliente', 'id_cliente');
        return view('informes.informeSupervision')->with(compact('clientes'));
    }

    public function resultadosInformeSupervision(Request $request) {
        try {
            $citas = CitaSupervision::with('cliente', 'supervisor', 'unidad.tipo_unidad', 'asignacionUnidad', 'unidad.marca', 'supervision')
                ->where('id_cliente', $request->idCliente)
                ->where('notificacion_citas', $request->status)
                ->whereYear('fecha_supervision', $request->year)
                ->whereMonth('fecha_supervision', $request->mes)
                ->get();

            return response()->json($citas);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    public function generarInformeSupervision($id_cliente, $status, $year, $mes) {
        $nombre = 'informe-supervision-' . $id_cliente . '-' . $status . '-' . $year . '-' . $mes . '.xlsx';
        return Excel::download(new InformeSupervisionExport($id_cliente, $status, $year, $mes), $nombre);
    }

    public function historialCitasUnidad($id_unidad, $id_cliente) {
        $cliente = cliente::find($id_cliente)->nombre_cliente;
        $unidad = unidad::find($id_unidad)->modelo;
        $nombre = str_replace(' ', '-', 'historial-citas-' . $cliente . '-' . $unidad . '-' . Carbon::now()->format('d-m-Y') . '.xlsx');
    
        return Excel::download(new InformeSupervisionPorUnidad($id_unidad, $id_cliente), $nombre);
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
}