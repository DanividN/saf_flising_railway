<?php

namespace App\Http\Controllers\administracion;

use App\Models\configuracion\unidad;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\tenenciaExport;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class unidadesTenenciaController extends Controller
{
    public function index()
    {
        $unidades = Unidad::whereIn('id_estado', ['1', '2', '3', '4', '8'])->orWhereNull('id_estado')->get();

        $currentYear = Carbon::now()->year;

        return view('administracion.tenencias.index',compact('unidades','currentYear'));
    }
    public function show($unidad)
    {
        Session::put('unidad', $unidad);
        return redirect()->route('tenencias.index');
    }

    public function edit($unidad)
    {
        Session::put('unidad', $unidad);

        return redirect()->route('tenencias.create');
    }
}
