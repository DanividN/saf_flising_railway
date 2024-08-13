<?php

namespace App\Http\Controllers\administracion;

use App\Http\Controllers\Controller;
use App\Models\administracion\emergencia;
use Illuminate\Http\Request;

class emergenciasController extends Controller
{
    public function index(){
        $data['emergencias'] = emergencia::getEmergencia();
        return view('administracion.emergencias.index', $data);
    }

    public function show($emergencia){
        $data['emergencia'] = emergencia::showEmergencia($emergencia);
        return view('administracion.emergencias.show', $data);
    }

    public function store(Request $request){
        $data = $request->all();
        emergencia::emergenciaStore($data);
        return redirect()->route('emergencias.index')->with('success', 'Estado de emergencia actualizado.');
    }
}
