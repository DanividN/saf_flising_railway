<?php

namespace App\Http\Controllers\administracion;

use App\Http\Controllers\Controller;
use App\Models\catalogos\plazoArrendamiento;
use App\Models\catalogos\terminoPlaca;
use App\Models\configuracion\agenciasTalleres;
use App\Models\configuracion\cliente;
use App\Models\configuracion\unidad;
use App\Models\administracion\asignacionUnidad;
use App\Models\administracion\detalleAsignacion;
use App\Models\administracion\unidadGarantia;
use App\Models\catalogos\estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class asignacionUnidadController extends Controller
{

    public function index()
    {
        return view('administracion.asignacionUnidad.index', ['clientes' => cliente::with('activos')->get()]);
    }

    public function getResponsables(cliente $cliente)
    {
        return response()->json($cliente->responsables()->where('activo', 1)->get());
    }

    public function getTerminacionPlacas(Request $id)
    {
        return response()->json(terminoPlaca::where('descripcion', 'LIKE', "%$id->id%")->first());
    }

    public function getGarantias(agenciasTalleres $proveedor)
    {
        return response()->json($proveedor->garantias);
    }

    public function getStep(asignacionUnidad $asignacionUnidade)
    {
        switch ($asignacionUnidade->etapa) {
            case 1:
                return redirect()->route('step2', $asignacionUnidade->id_asignacion_unidad);
                break;
            case 2:
                return redirect()->route('step3', $asignacionUnidade->id_asignacion_unidad);
                break;
            case 3:
                return redirect()->route('step4', $asignacionUnidade->id_asignacion_unidad);
                break;
        }
    }

    public function step1()
    {
        return view('administracion.asignacionUnidad.create.step1', [
            'clientes' => cliente::select('id_cliente', 'nombre_cliente')->get(),
            'unidades' => unidad::select('id_unidad', 'vehiculo_id')->whereHas('estado', function ($q) {
                $q->where('accion', 'DISPONIBLE');
            })->orWhereNull('id_estado')->get(), //<-- falta agregar validacion de unidad activa por si acaso
            'plazos' => plazoArrendamiento::get(),
        ]);
    }

    public function store1(Request $request)
    {
        $data = $request->validate([
            'id_cliente' => 'required',
            'id_unidad' => 'required',
            'id_responsable' => 'required',
            'plazo_arrendamiento' => 'required',
            'fecha_inicial' => 'required',
            'fecha_final' => 'required',
        ]);
        $unidad = unidad::findOrFail($data['id_unidad']);


        if ($unidad->estado && $unidad->estado->accion !== 'DISPONIBLE')
            return back()->with('unidad', 'Unidad no disponible');
        $asignacion = asignacionUnidad::create([...$data, 'activo' => 1, 'etapa' => 1]);

        $detalle = detalleAsignacion::create([
            'id_asignacion_unidad' => $asignacion->id_asignacion_unidad,
            'id_estado' => 1,
        ]);

        $estado = count($unidad->arrendamientos()->whereHas('DetalleAsignacion', function ($q) {
            $q->where('id_estado', '<>', 8);
        })->get()) > 1 ? 2 : 1;
        $unidad->id_estado = $estado;
        $unidad->save();
        $detalle->fill(['id_estado' => $estado])->save();

        return redirect()->route('step2', $asignacion->id_asignacion_unidad);
    }

    public function step2(asignacionUnidad $asignacionUnidade)
    {
        if ($asignacionUnidade->etapa < 1) return $this->getStep($asignacionUnidade);

        $asignacionUnidade->load('Unidad', 'Plazo', 'Cliente', 'Responsable', 'DetallesAsignacion.estado');
        return view('administracion.asignacionUnidad.create.step2', [
            'terminacion_placas' => terminoPlaca::get(),
            'asignacionUnidade' => $asignacionUnidade
        ]);
    }

    public function store2(asignacionUnidad $asignacionUnidade, Request $request)
    {
        $data = $request->validate([
            'placas' => 'required|regex:/^[\w\-]+$/',
            'terminacion_placas' => 'required',
            'primer_semestre' => 'required',
            'segundo_semestre' => 'required',
            'cambio_laminas' => 'required',
            'reposicion_laminas' => 'required',
            'a_alta_placas' => 'nullable|mimes:pdf',
            'a_derechos_vehiculares' => 'nullable|mimes:pdf',
            'a_tarjeta_circulacion' => 'nullable|mimes:pdf',
            'cambio_tarjeta_circulacion' => 'required',
        ]);
        if ($asignacionUnidade->placas !== $request->placas) $request->validate(['placas' => 'unique:asignacion_unidades,placas']);

        $ruta = 'administracion/asignacionUnidad/' . $asignacionUnidade->id_asignacion_unidad;
        $files = mover_archivos($request, ['a_alta_placas', 'a_derechos_vehiculares', 'a_tarjeta_circulacion'], null, $ruta);
        $data = array_merge($data, $files);
        $etapa = $asignacionUnidade->etapa > 2 ? $asignacionUnidade->etapa : 2;
        $asignacionUnidade->fill([...$data, 'etapa' => $etapa])->save();

        return redirect()->route('step3', $asignacionUnidade->id_asignacion_unidad);
    }

    public function step3(asignacionUnidad $asignacionUnidade)
    {
        if ($asignacionUnidade->etapa !== 4 && count($asignacionUnidade->unidad->arrendamientos()->whereHas('DetalleAsignacion', function ($q) {
            $q->where('id_estado', '!=', 8);
        })->get()) > 1) {
            $asignacionUnidade->fill(['etapa' => 3])->save();
            if (redirect()->getUrlGenerator()->previous() == route('step4', $asignacionUnidade->id_asignacion_unidad))
                return redirect()->route('step2', $asignacionUnidade->id_asignacion_unidad);
            else
                return redirect()->route('step4', $asignacionUnidade->id_asignacion_unidad);
        }

        if ($asignacionUnidade->etapa < 2) return $this->getStep($asignacionUnidade);

        $asignacionUnidade->load('Unidad', 'Plazo', 'Cliente', 'Responsable', 'DetallesAsignacion.estado');
        return view('administracion.asignacionUnidad.create.step3', [
            'proveedores' => agenciasTalleres::where('tipo', 'AGENCIA')->get(),
            'asignacionUnidade' => $asignacionUnidade,
            'garantias' => $asignacionUnidade->Unidad_garantias()->with('garantiaProveedor')->get(),
        ]);
    }

    public function store3(asignacionUnidad $asignacionUnidade, Request $request)
    {
        $request["garantiasAsignadas"] = json_decode($request["garantiasAsignadas"], true);


        foreach ($asignacionUnidade->Unidad_garantias as &$garantia) {
            DB::table('unidad_garantias')
                ->where('id_unidad', $garantia->id_unidad)
                ->where('id_garantia_proveedor', $garantia->id_garantia_proveedor)
                ->where('id_asignacion_unidad', $garantia->id_asignacion_unidad)
                ->where('tipo', 'GARANTIAS EXTENDIDAS')
                ->delete();
        }


        if ($request['registro'] == 'true') {
            $data = $request->validate([
                'garantiasAsignadas' => 'required|Array',
            ]);
            foreach ($data['garantiasAsignadas'] as &$id) {
                unidadGarantia::create([
                    'id_unidad' => $asignacionUnidade->id_unidad,
                    'id_garantia_proveedor' => $id,
                    'id_asignacion_unidad' => $asignacionUnidade->id_asignacion_unidad,
                    'tipo' => 'GARANTIAS EXTENDIDAS'
                ]);
            }
        }

        $asignacionUnidade->fill(['etapa' => 3])->save();
        return redirect()->route('step4', $asignacionUnidade->id_asignacion_unidad);
    }

    public function step4(asignacionUnidad $asignacionUnidade)
    {
        if ($asignacionUnidade->etapa < 3) return $this->getStep($asignacionUnidade);

        $asignacionUnidade->load('Unidad', 'Plazo', 'Cliente', 'Responsable', 'DetallesAsignacion.estado');
        return view('administracion.asignacionUnidad.create.step4', [
            'asignacionUnidade' => $asignacionUnidade
        ]);
    }

    public function store4(asignacionUnidad $asignacionUnidade, Request $request)
    {

        $booleanCampos = [
            'politica_uso', 'informacion_movilidad', 'comunicados_generales',
            'informacion_mormont', 'talon_verificacion', 'llave_repuesto',
            'gato_hidraulico', 'triangulo_seguridad', 'manual_usuario',
            'engomado', 'placas_check', 'poliza_mantenimiento', 'llanta_refaccion',
            'poliza_seguro', 'tarjeta_circulacion'
        ];
        $data = $request->all();
        foreach ($booleanCampos as $campo) {
            if (array_key_exists($campo, $data))
                $data[$campo] = true;
            else $data[$campo] = false;
        }

        $request->validate([
            'a_entrega' => 'nullable|mimes:pdf',
        ]);

        $ruta = 'administracion/asignacionUnidad/' . $asignacionUnidade->id_asignacion_unidad;
        $data = array_merge($data, mover_archivos($request, ['a_entrega'], null, $ruta));

        $asignacionUnidade->fill([...$data, 'etapa' => 4])->save();
        return redirect()->route('asignacionUnidades.show', $asignacionUnidade->id_cliente)
            ->with('success', 'Unidad asignada exitosamente');
    }

    public function show(cliente $cliente)
    {
        return view('administracion.asignacionUnidad.show', [
            'cliente' => $cliente,
            'arrendamientos' => $cliente->historialArrendamientos()->with('Unidad.marca', 'DetallesAsignacion', 'DetalleAsignacion.estado', 'Plazo')->get(),
            'estatus' => estado::where('accion', '<>', 'OCUPADA')->where('tipo', 2)->get(),
        ]);
    }

    public function estado(asignacionUnidad $asignacionUnidade, Request $request)
    {

        $estado = $request->id_estado;

        $unidad = $asignacionUnidade->unidad;
        $unidad->id_estado = $estado;
        $asignacionUnidade->activo = 0;
        $asignacionUnidade->etapa = 4;

        $asignacionUnidade->save();
        $unidad->save();

        detalleAsignacion::create([
            'id_asignacion_unidad' => $asignacionUnidade->id_asignacion_unidad,
            'id_estado' => $estado,
        ]);

        return back();
    }
}
