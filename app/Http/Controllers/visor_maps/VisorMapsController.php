<?php

namespace App\Http\Controllers\visor_maps;

use App\Http\Controllers\Controller;
use App\Models\visor_maps\VisorMaps;
use Illuminate\Http\Request;

class VisorMapsController extends Controller
{
    public function index(){
        $agencias = VisorMaps::getAgencias();
        $clientes = VisorMaps::getClientes();
        return view('visor_maps.index')
        ->with('agencias', $agencias)
        ->with('clientes', $clientes);
    }

    public function getAgencias(Request $request){
        $agencias = VisorMaps::getAgencias();
        return response()->json($agencias);
    }

    public function getTalleres(Request $request){
        $agencias = VisorMaps::getTalleres();
        return response()->json($agencias);
    }

    public function getVerificentros(Request $request){
        $verificentros = VisorMaps::getVerificentros();
        return response()->json($verificentros);
    }

    public function getClientes(Request $request){
        $id_cliente = $request->id_cliente;
        $clientes = VisorMaps::getClientesById($id_cliente);
        return response()->json($clientes);
    }
}
