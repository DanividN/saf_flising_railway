<?php

namespace App\Http\Controllers\catalogos;

use App\Http\Controllers\Controller;
use App\Models\catalogos\polizaSeguro;
use Illuminate\Http\Request;

class polizaSeguroController extends Controller
{
    public function index($id_aseguradora)
    {
        $polizas = polizaSeguro::where('activo', 1)->where('id_aseguradora', $id_aseguradora)->get();
        return response()->json($polizas);
    }
}
