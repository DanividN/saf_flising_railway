<?php

namespace App\Http\Controllers\funciones;

use App\Exports\Verificacion\InformeExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\funciones\verificacion\seguimientoRequest;
use App\Http\Requests\funciones\verificacion\verificacionRequest;
use App\Models\configuracion\unidad;
use App\Models\catalogos\entidadFederativa;
use App\Models\catalogos\holograma;
use App\Models\catalogos\municipio;
use App\Models\funciones\citaVerificacion;
use App\Models\funciones\seguimientoVerificacion;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Verificacion\verificacionExport;
use App\Models\catalogos\year;
use App\Models\configuracion\cliente;
use App\Models\funciones\callCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class verificacionController extends Controller
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

    private $priorities = ['VENCIDO' => 1, 'PENDIENTE' => 2, 'CONCLUIDO' => 3, 'VIGENTE' => 4];

    private function folioCita(citaVerificacion $cita)
    {
        $cita->folio = 'V' . (($cita->Seguimiento ?? false) ? 'C' : 'A') . '-' . str_pad($cita->id_citas_verificaciones, 4, '0', STR_PAD_LEFT);
    }

    public function getEstado(unidad $unidad)
    {
        $mesActual = intval(date('n'));
        $añoActual = date('Y');
        $actualDate = Carbon::parse('');

        $primerSemestre = explode(' - ', strtolower($unidad->UltimoArrendamiento->primer_semestre));
        $segundoSemestre = explode(' y ', strtolower($unidad->UltimoArrendamiento->segundo_semestre));
        $periodo = $mesActual < $this->meses[$segundoSemestre[0]];

        if (($unidad->UltimaVerificacion->estado ?? '') == 'CONCLUIDO')
            $givenDate = Carbon::parse($unidad->UltimaVerificacion->fecha_hora_verificacion ?? 0);
        else $givenDate = Carbon::parse(0);

        $fechas = [
            0 => Carbon::create($añoActual, $this->meses[($periodo ? $primerSemestre : $segundoSemestre)[0]], 1),
            1 => Carbon::create($añoActual, $this->meses[($periodo ? $primerSemestre : $segundoSemestre)[1]])->endOfMonth(),
            2 => $periodo ? Carbon::create($añoActual, $this->meses[$segundoSemestre[0]]) : Carbon::create('')->endOfYear(),
        ];

        $holograma = explode(' ', $unidad->UltimaVerificacion->Seguimiento->Holograma->tiempo ?? ' ');
        $fechaHolograma = Carbon::parse($unidad->UltimaVerificacion->Seguimiento->fecha_verificacion ?? null)->addYears(intval($holograma[0]));
        if (($unidad->UltimaVerificacion->Seguimiento->periodo ?? '') == 'PRIMER PERIODO')
            $fechaHolograma->addMonths($this->meses[$segundoSemestre[0]] - $fechaHolograma->month)->startOfMonth();
        else $fechaHolograma->endOfYear();

        if ($givenDate->between($fechas[0], $fechas[2]))
            return ['CONCLUIDO', $periodo];
        else if ($holograma[1] == 'años' && $actualDate->lt($fechaHolograma))
            return ['VIGENTE', $periodo];
        else if ($actualDate->between($fechas[0], $fechas[1]))
            return ['PENDIENTE', $periodo];
        else if ($actualDate->lt($fechas[0]))
            return ['VIGENTE', $periodo];
        else return ['VENCIDO', $periodo];
    }

    public function verificentros(municipio $municipio)
    {
        return response()->json($municipio->verificentros);
    }

    public function indexAdministracion()
    {
        return view('funciones.verificaciones.index', [
            'unidades' => unidad::with('UltimoArrendamiento.Cliente', 'UltimaVerificacion.Seguimiento', 'marca')->whereHas('UltimoArrendamiento', function ($q) {
                $q->where('activo', '0')->whereNotNull('placas');
            })->get()->map(function ($unidad) {
                $unidad->estado = $this->getEstado($unidad);
                return $unidad;
            })->sortBy(function ($unidad) {
                return $this->priorities[$unidad->estado[0]];
            }),
            'entidades' => entidadFederativa::get(),
        ]);
    }

    public function indexFunciones()
    {
        return view('funciones.verificaciones.index', [
            'unidades' => unidad::with('UltimoArrendamiento.Cliente', 'UltimaVerificacion.Seguimiento', 'marca')->whereHas('UltimoArrendamiento', function ($q) {
                $q->where('activo', '1')->where('etapa', '>', 1);
            })->whereHas('UltimoArrendamiento.Cliente', function ($q) {
                $q->whereIn('id_cliente', Auth::user()->usuarioClientes->pluck('id_cliente'));
            })->whereHas('UltimoArrendamiento.Responsable', function ($q) {
                $q->where('vip', Auth::user()->vip);
            })->get()->map(function ($unidad) {
                $unidad->estado = $this->getEstado($unidad);
                return $unidad;
            })->sortBy(function ($unidad) {
                return $this->priorities[$unidad->estado[0]];
            }),
            'entidades' => entidadFederativa::get(),
        ]);
    }

    public function informacion(unidad $unidad)
    {
        $unidad->load('UltimaVerificacion');
        $givenDate = Carbon::parse($unidad->UltimaVerificacion->fecha_hora_verificacion ?? 0);
        if ($unidad->UltimaVerificacion && $unidad->UltimaVerificacion->estado == 'AGENDADO' && Carbon::parse('')->gt($givenDate))
            $unidad->UltimaVerificacion->update(['estado' => 'VENCIDO']);

        $unidad->load(
            'marca',
            'HistorialVerificacion.Seguimiento',
            'HistorialVerificacion.arrendamiento.Cliente',
            'UltimoArrendamiento.Cliente',
            'UltimoArrendamiento.Responsable'
        );

        foreach ($unidad->HistorialVerificacion as $cita) {
            $this->folioCita($cita);
        }

        $unidad->estado = $this->getEstado($unidad);
        return view('funciones.verificaciones.informacion', [
            'unidad' => $unidad,
            'entidades' => entidadFederativa::get(),
        ]);
    }

    public function agendar(unidad $unidad, verificacionRequest $request)
    {
        $data = array_merge($request->all(), mover_archivos($request, ['a_cita'], null, 'funciones/verificacion/' . $unidad->id_unidad));

        citaVerificacion::create([
            ...$data, 'estado' => 'AGENDADO', 'id_unidad' => $unidad->id_unidad,
            'id_asignacion_unidad' => $unidad->UltimoArrendamiento->id_asignacion_unidad
        ]);
        return back()->with('success', 'Cita agendada correctamente');
    }

    public function show(citaVerificacion $cita)
    {
        $cita->load(
            'arrendamiento.Cliente',
            'arrendamiento.Responsable',
            'Seguimiento',
            'Unidad.marca',
            'Unidad.tipo_unidad',
            'Unidad.datosAseguradora.aseguradora',
            'Unidad.datosAseguradora.gps',
            'Unidad.datosAseguradora.polizas'
        );
        $cita->Unidad->estado=$this->getEstado($cita->Unidad);
        return view('funciones.verificaciones.show', ['cita' => $cita, 'hologramas' => holograma::get()]);
    }

    public function store(citaVerificacion $cita, seguimientoRequest $request)
    {
        if ($request->estado == 'CANCELADO') $cita->update(['estado' => 'CANCELADO']);
        else {
            $data = array_merge($request->all(), mover_archivos($request, ['a_comprobante_multa', 'a_evidencia_verificacion'], null, 'funciones/verificacion/' . $cita->id_citas_verificaciones));
            if ($cita->Seguimiento) $cita->Seguimiento->update($data);
            else
                seguimientoVerificacion::create([...$data, 'id_citas_verificaciones' => $cita->id_citas_verificaciones]);
            $cita->update(['estado' => 'CONCLUIDO']);
        }

        return redirect()->route('verificacion.informacion', $cita->id_unidad)->with('success', 'Guardado correctamente');
    }

    public function dowload(unidad $unidad)
    {
        $unidad->load('marca', 'UltimoArrendamiento.Responsable', 'UltimoArrendamiento.Cliente', 'HistorialVerificacion.Seguimiento', 'HistorialVerificacion.arrendamiento.Cliente');

        foreach ($unidad->HistorialVerificacion as $cita) {
            $this->folioCita($cita);
        }

        return Excel::download(new verificacionExport($unidad), 'Informe Verificación.xlsx');
    }

    public function miRegistro(unidad $unidad, Request $request)
    {
        callCenter::create([
            ...$request->validate([
                'tipo_llamada' => 'required',
                'estatus' => 'required',
                'descripcion' => 'nullable'
            ]),
            'fecha' => Carbon::now('America/Mexico_City')->format("Y-m-d"),
            'hora' => Carbon::now('America/Mexico_City')->format("H:i"),
            'modulo' => 1,
            'id_callcenter' => Auth::user()->id,
            'id_asignacion_unidad' => $unidad->UltimoArrendamiento->id_asignacion_unidad,
        ]);
        return back()->with('success', 'Registro agregado correctamente');
    }

    public function showInforme()
    {
        return view('informes.informeVerificaciones', [
            'clientes' => cliente::get(),
            'meses' => $this->meses,
            'estatus' => $this->priorities,
            'años' => year::get(),
        ]);
    }

    public function informe(Request $request)
    {
        return response()->json(
            unidad::with('UltimoArrendamiento.Cliente', 'UltimaVerificacion.Seguimiento', 'marca')->whereHas('UltimoArrendamiento', function ($q) {
                $q->whereNotNull('placas');
            })->whereHas('UltimoArrendamiento.Cliente', function ($q) use ($request) {
                $q->where('id_cliente', $request->cliente);
            })->get()->filter(function ($unidad) use ($request) {
                $unidad->estado = $this->getEstado($unidad);
                $FechaI = Carbon::create($request->año, $request->mes);
                $FechaF = clone $FechaI;

                if (($unidad->UltimaVerificacion->estado ?? '') == 'CONCLUIDO')
                    $givenDate = Carbon::parse($unidad->UltimaVerificacion->fecha_hora_verificacion ?? 0);
                else $givenDate = Carbon::parse('');

                return (
                    $this->priorities[$unidad->estado[0]] == $request->estatus &&
                    $unidad->estado[1] == ($request->periodo == '1') &&
                    $givenDate->between($FechaI, $FechaF->endOfMonth())
                );
            })->values()->all()
        );
    }

    public function dowloadInforme(Request $request)
    {
        return Excel::download(new InformeExport($this->informe($request)->getData()), 'Informe Verificación.xlsx');
    }
}
