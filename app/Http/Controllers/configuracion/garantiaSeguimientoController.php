<?php

namespace App\Http\Controllers\configuracion;

use File;
use Illuminate\Http\Request;
use App\Models\catalogos\municipio;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\configuracion\garantia\garantiaFlisingExtendida;
use App\Http\Requests\configuracion\garantias\garantiaSeguimientoRequest;

class garantiaSeguimientoController extends Controller
{
    public function index()
    {
        $garantia = Session::get('garantia');
        $municipiosAll = municipio::all();
        $garantias_flising_extendidas = garantiaFlisingExtendida::where('id_g_flising', $garantia->id_g_flising)->get();
        $e =1;
        // dd($garantias_flising_extendidas);
        return view('configuracion.garantias.garantias_seguimiento.index', compact(
            'garantia', 
            'municipiosAll',
            'garantias_flising_extendidas',
            'e'
        ));


    }

    function store(garantiaSeguimientoRequest $request) {
        if ($request->vigencia_g_extendida > 0) {
            $montoGExtendida = str_replace(',', '', $request->monto_g_extendida);
            $eventos = intval($request->eventos_por_year);
            $garantia = Session::get('garantia');
            $ruta = 'configuracion/garantias';
            $files = mover_archivos($request, ['a_evidencia_extendida'], null, $ruta);
            $request['id_g_flising'] = $garantia->id_g_flising;
            $request['activo'] = $request->activo_hidden;
            ($request['monto_g_extendida'] =  $montoGExtendida )||( $request['monto_g_extendida'] = 0);
            $request['eventos_por_year'] =  $eventos;
            $data = $request->all();

            $data = array_merge($data,$files);
            garantiaFlisingExtendida::create($data);
        }
        return redirect()->back()
        ->with('success', 'Garantia agregada exitosamente');
       
    }
    
    public function update(garantiaSeguimientoRequest $request, $id){
        if ($request->vigencia_g_extendida > 0) {
            $montoGExtendida = str_replace(',', '', $request->monto_g_extendida);
            $eventos = intval($request->eventos_por_year);
            $id_g_flising_extendidas = $request->id_g_flising_extendidas;
            $garantiaExtendida = garantiaFlisingExtendida::findOrFail($id_g_flising_extendidas);
            $ruta = 'configuracion/garantias';
            $request['activo'] = $request->activo_hidden;
            //Obtener datos antiguos de archivo
            $old_data = $garantiaExtendida->only(['a_evidencia_extendida']);
            // Manejar archivos y obtener nueva ruta 
            $files = mover_archivos($request, ['a_evidencia_extendida'], $old_data, $ruta);
            ($request['monto_g_extendida'] =  $montoGExtendida )||( $request['monto_g_extendida'] = 0);
            $request['eventos_por_year'] =  $eventos;
            $files = is_array($files) ? $files : [];
            $garantiaExtendida->update(array_merge(
                $request->all(),
                $files
            ));
        }
       

        return redirect()->back()
        ->with('success', 'Garantia actualizada exitosamente');

    }
    
}
