<?php

namespace App\Models\visor_maps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class VisorMaps extends Model
{
    use HasFactory;
    protected $table = 'proveedores';
    public $primaryKey = 'id_proveedor';

    public static function getAgencias(){
        $agencias = DB::table('proveedores')
        ->join('municipios','municipios.id_municipio','=','proveedores.id_municipio')
        ->select(
            'proveedores.*',
            'municipios.*',
        )
        ->where('proveedores.tipo','AGENCIA')
        ->get();
        return $agencias;
    }

    public static function getTalleres(){
        $agencias = DB::table('proveedores')
        ->join('municipios','municipios.id_municipio','=','proveedores.id_municipio')
        ->select(
            'proveedores.*',
            'municipios.*',
        )
        ->where('proveedores.tipo','TALLER')
        ->get();
        return $agencias;
    }

    
    public static function getVerificentros(){
        $verificentros = DB::table('verificentros')
        ->join('municipios','municipios.id_municipio','=','verificentros.id_municipio')
        ->select(
            'verificentros.*',
            'municipios.nombre_municipio',
        )
        ->get();
        return $verificentros;
    }

    public static function getClientes(){
        $clientes = DB::table('asignacion_unidades')
        ->join('clientes','clientes.id_cliente','=','asignacion_unidades.id_cliente')
        ->select(
            'clientes.*'
        )
        ->distinct('asignacion_unidades.id_cliente')
        ->get();
        return $clientes;
    }

    public static function getClientesById($id_cliente){
        $clientes = DB::table('asignacion_unidades')
        ->join('clientes','clientes.id_cliente','=','asignacion_unidades.id_cliente')
        ->select(
            'clientes.*'
        )
        ->where('clientes.id_cliente', $id_cliente)
        ->get();
        return $clientes;
    }

    
}
