<?php

namespace App\Models\configuracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class agenciasTalleres extends Model
{
    use HasFactory;
    protected $table = 'proveedores';
    public $primaryKey = 'id_proveedor';

    protected $fillable = [
        'tipo',
        'servicios',
        'razon_social',
        'nombre_comercial',
        'telefono_proveedor',
        'rfc_proveedor',
        'correo_proveedor',
        'calle_proveedor',
        'n_exterior',
        'colonia',
        'id_municipio',
        'cp_proveedor',
        'direccion_proveedor',
        'cx',
        'cy',
        'activo'
    ];

    public static function getProveedores(){
        $proveedores = DB::table('proveedores')
        ->join('municipios','municipios.id_municipio','=','proveedores.id_municipio')
        ->select(
            'proveedores.*', 
            DB::RAW('DATE(created_at) as fecha_registro'),
            'municipios.nombre_municipio'
            )
        ->get();
        return $proveedores;
    }

    public static function getProveedoresById($id_proveedor){
        $proveedor = DB::table('proveedores')
        ->join('municipios','municipios.id_municipio','=','proveedores.id_municipio')
        ->select(
            'proveedores.*', 
            DB::RAW('DATE(created_at) as fecha_registro'),
            'municipios.nombre_municipio'
            )
        ->where('proveedores.id_proveedor', $id_proveedor)
        ->get();
        return $proveedor;
    }

    public static function getGarantiasByProveedor($id_proveedor){
        $garantias = DB::table('garantia_proveedores')
        ->where('id_proveedor', $id_proveedor)
        ->select('*')
        ->get();
        return $garantias;
    }

    public static function getEntidades(){
        $entidades = DB::table('entidades_federativas')
        ->select('*')
        ->get();
        return $entidades;
    }

    public static function getMunicipios($id_estado){
        $municipios = DB::table('municipios')
        ->where('id_entidad_federativa', $id_estado)
        ->select('*')
        ->get();
        return $municipios;
    }

    public static function getMunicipiosAll(){
        $municipios = DB::table('municipios')
        ->select('*')
        ->get();
        return $municipios;
    }

    public static function insertProveedor($data){
        $proveedor = DB::table('proveedores')->insertGetId($data);
        return $proveedor;
    }

    public static function countContactos($id_proveedor){
        $count = DB::table('contactos_servicios')
        ->where('id', $id_proveedor)
        ->count();
        return $count;
    }

    public static function deleteContactos($id_proveedor){
        $delete = DB::table('contactos_servicios')
        ->where('id', $id_proveedor)
        ->where('tipo_contacto', 'PROVEEDORES')
        ->delete();
    }

    // Relación con Contactos
    public function contactos(){
        return $this->hasMany('App\Models\catalogos\contactos', 'id', 'id_proveedor');
    }
    // Relación con Municipios
    public function municipios()
    {
        return $this->belongsTo('App\Models\catalogos\municipio', 'id_municipio', 'id_municipio');
    }

    public function garantias(){
        return $this->hasMany('App\Models\configuracion\garantiasProveedores', 'id_proveedor', 'id_proveedor');
    }

}
