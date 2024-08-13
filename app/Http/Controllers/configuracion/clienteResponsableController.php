<?php

namespace App\Http\Controllers\configuracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\configuracion\clienteResponsableRequest;
use App\Models\configuracion\cliente;
use App\Models\configuracion\responsable;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class clienteResponsableController extends Controller
{
    public function index(Request $request)
    {
        $cliente = Session::get('cliente');
        $responsables = responsable::where('id_cliente', $cliente->id_cliente)
        ->orderBy('activo', 'desc')
        ->get();

        return view('configuracion.clienteResponsable.index',compact('cliente','responsables'));
    }
    public function create()
    {
        return view('configuracion.clienteResponsable.create');
    }
    public function store(clienteResponsableRequest $request)
    {
        $cliente = Session::get('cliente');
        $request['id_cliente'] = $cliente->id_cliente;
        $request['activo'] = 1;
        $ruta='configuracion/responsables';
        $files = mover_archivos($request, ['a_ine_responsable'], null,$ruta);
        $files = is_array($files) ? $files : [];
        $data = $request->all();
        $data = array_merge($data,$files);

        responsable::create($data);

        return redirect()->route('responsables.index')->with('success', 'Registro de responsable guardado con éxito.');
    }
    public function show($responsable)
    {
        $data = Responsable::findOrFail($responsable);
        return response()->json($data);
    }

    public function update(clienteResponsableRequest $request, responsable $responsable)
    {
        $ruta='configuracion/responsables';
        $old_data = $responsable->only(['a_ine_responsable']);
        $files = mover_archivos($request, ['a_ine_responsable'], $old_data, $ruta) ?? [];
        $files = is_array($files) ? $files : [];
        $responsable->update(array_merge(
            $request->except(['a_ine_responsable']),
            $files
        ));

        return redirect()->route('responsables.index')->with('success', 'Registro de responsable actualizado con éxito.');
    }
    public function destroy(responsable $responsable)
    {
        //
    }
}
