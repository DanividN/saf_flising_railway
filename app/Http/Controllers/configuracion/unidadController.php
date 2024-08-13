<?php

namespace App\Http\Controllers\configuracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\configuracion\unidadRequest;
use App\Models\administracion\asignacionUnidad;
use App\Models\catalogos\estado;
use App\Models\catalogos\mantenimientoTiempo;
use App\Models\catalogos\marca;
use App\Models\catalogos\tipoUnidad;
use App\Models\catalogos\year;
use App\Models\configuracion\agenciasTalleres;
use App\Models\configuracion\unidad;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class unidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unidades = unidad::with('estado')->get();
        $estado = estado::whereIn('id_estado', [5, 6])->get();

        return view('configuracion.unidades.index', compact('unidades', 'estado'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipo_unidades = tipoUnidad::all();
        $years = year::all();
        $marcas = marca::all();
        $tiempos = mantenimientoTiempo::whereIn('id_mantenimiento_tiempo',[6,12,18,24,32])->get();
        $preveedores = agenciasTalleres::all();

        return view('configuracion.unidades.create', compact('tipo_unidades', 'years', 'marcas', 'tiempos', 'preveedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(unidadRequest $request)
    {
        $ruta = 'configuracion/unidades';
        $files = mover_archivos($request, [
            'a_factura',
            'a_garantia_fabrica',
            'a_manual_servicio',
            'a_garantia_contractual',
            'a_garantia_unidad'
        ], null, $ruta);
        $request['activo'] = 1;
        $fecha = Carbon::createFromFormat('d/m/Y', $request->fecha_mantenimiento);
        if ($fecha->year != Carbon::now()->year) {
            return redirect()->back()->withErrors(['fecha_mantenimiento' => 'La fecha debe pertenecer al año actual.']);
        }
        $request['fecha_mantenimiento'] = $fecha->format('Y-m-d');
        $data = $request->all();
        $data = array_merge($data, $files);
        unidad::create($data);

        return redirect()->route('unidades.index')->with('success', 'Unidad guardado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(unidad $unidade)
    {
        return view('configuracion.unidades.historial', compact('unidade'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(unidad $unidade)
    {
        $tipo_unidades = tipoUnidad::all();
        $years = year::all();
        $marcas = marca::all();
        $tiempos = mantenimientoTiempo::whereIn('id_mantenimiento_tiempo',[6,12,18,24,32])->get();
        $preveedores = agenciasTalleres::all();

        return view('configuracion.unidades.edit', compact('unidade', 'tipo_unidades', 'years', 'marcas', 'tiempos', 'preveedores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(unidadRequest $request, unidad $unidade)
    {
        $ruta = 'configuracion/unidades';
        $old_data = $unidade->only(['a_factura', 'a_garantia_fabrica', 'a_manual_servicio', 'a_garantia_contractual', 'a_garantia_unidad']);
        $files = mover_archivos($request, ['a_factura', 'a_garantia_fabrica', 'a_manual_servicio', 'a_garantia_contractual', 'a_garantia_unidad'], $old_data, $ruta) ?? [];
        $files = is_array($files) ? $files : [];
        if ($request->filled('fecha_mantenimiento')) {
            $fecha = Carbon::parse($request->fecha_mantenimiento);

            if ($fecha->year != Carbon::now()->year) {
                return redirect()->back()->withErrors(['fecha_mantenimiento' => 'La fecha debe pertenecer al año actual.']);
            }

            // Formatear la fecha para la actualización (si es necesario)
            $request['fecha_mantenimiento'] = $fecha->format('Y-m-d');
        }
        $unidade->update(array_merge(
            $request->except(['a_factura', 'a_garantia_fabrica', 'a_manual_servicio', 'a_garantia_contractual', 'a_garantia_unidad']),
            $files
        ));

        return redirect()->route('unidades.index')->with('success', 'Unidad actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(unidad $unidad)
    {
        //
    }
    public function getProveedores(Request $request)
    {
        $id_proveedor = $request->id_proveedor;
        $datos = unidad::getProveedor($id_proveedor);

        return response()->json($datos);
    }
    function estatus(Request $request, unidad $unidade)
    {
        $request->validate([
            'id_estado' => 'required|integer|exists:estados,id_estado',
        ]);

        $unidade->update([
            'id_estado' => $request->id_estado,
            'activo' => 0
        ]);

        return redirect()->route('unidades.index')->with('success', 'Unidad actualizada correctamente.');
    }
}
