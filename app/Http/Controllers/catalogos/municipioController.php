<?php

namespace App\Http\Controllers\catalogos;

use App\Http\Controllers\Controller;
use App\Models\catalogos\municipio;
use Illuminate\Http\Request;

class municipioController extends Controller
{
    public function index($id_estado)
    {
        $municipios = municipio::where('id_entidad_federativa', $id_estado)->get();
        return response()->json($municipios);
    }
}
