<?php

namespace App\Http\Controllers\configuracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\configuracion\clienteRequest;
use App\Models\catalogos\entidadFederativa;
use App\Models\catalogos\municipio;
use App\Models\catalogos\tipoCliente;
use App\Models\configuracion\cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class clienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = cliente::all()->where('activo',1);

        return view('configuracion.clientes.index',compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipos_clientes = tipoCliente::all();
        $entidad_federativa = cliente::getEntidades();

        return view('configuracion.clientes.create', compact('tipos_clientes','entidad_federativa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(clienteRequest $request)
    {
        $ruta='configuracion/clientes';
        $files = mover_archivos($request, ['a_identificacion','a_situacion_fiscal','a_comprobante_domicilio'], null,$ruta);
        $request['activo'] = 1;
        $data = $request->all();
        $data = array_merge($data,$files);
        cliente::create($data);

        return redirect()->route('clientes.index')->with('success', 'Registro de cliente guardado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(cliente $cliente)
    {
        Session::put('cliente', $cliente);
        return redirect()->route('responsables.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cliente $cliente)
    {
        $tipos_clientes = tipoCliente::all();
        $entidad_federativa = entidadFederativa::all();
        $municipios = municipio::all();

        return view('configuracion.clientes.edit', compact('tipos_clientes','entidad_federativa','municipios','cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(clienteRequest $request, cliente $cliente)
    {
        $ruta='configuracion/clientes';
        $old_data = $cliente->only(['a_identificacion', 'a_situacion_fiscal', 'a_comprobante_domicilio']);
        $files = mover_archivos($request, ['a_identificacion', 'a_situacion_fiscal', 'a_comprobante_domicilio'], $old_data, $ruta) ?? [];
        $files = is_array($files) ? $files : [];
        $cliente->update(array_merge(
            $request->except(['a_identificacion', 'a_situacion_fiscal', 'a_comprobante_domicilio']),
            $files
        ));
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cliente $cliente)
    {
        //
    }
    public function getMunicipios(Request $request){
        $id_estado = $request->id_estado;
        $municipios = cliente::getMunicipios($id_estado);
        return response()->json($municipios);
    }
    public function lectura(cliente $cliente) {
        $municipios = municipio::where('id_municipio',$cliente->id_municipio)->first();
        $entidad_federativa = entidadFederativa::where('id_entidad_federativa',$municipios->id_entidad_federativa)->first();

        return view('configuracion.clientes.show', compact('entidad_federativa','municipios','cliente'));
    }
}
