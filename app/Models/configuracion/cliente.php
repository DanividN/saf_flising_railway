<?php

namespace App\Models\configuracion;

use App\Models\catalogos\municipio;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\administracion\asignacionUnidad;
use App\Models\configuracion\responsable;

// use App\Models\funcionesFlising\asignacionUnidad;
use DB;
class cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    public $primaryKey = 'id_cliente';

    protected $fillable = [
        'tipo_cliente',
        'nombre_cliente',
        'rfc',
        'calle',
        'n_interior',
        'n_exterior',
        'id_municipio',
        'codigo_postal',
        'nombre_representante',
        'correo_representante',
        'telefono_cliente',
        'a_identificacion',
        'a_situacion_fiscal',
        'a_comprobante_domicilio',
        'direccion_cliente',
        'cx',
        'cy',
        'activo',
        'created_at',
        'updated_at',
    ];

    public function activos()
    {
        return $this->hasMany(asignacionUnidad::class,'id_cliente')->where('activo',1);
    }

    public function historialArrendamientos()
    {
        return $this->hasMany(asignacionUnidad::class,'id_cliente')->orderBy('created_at','desc');
    }

    public function responsables()
    {
        return $this->hasMany(responsable::class,'id_cliente');
    }
    public function responsable() {
        return $this->hasOne(responsable::class,'id_cliente');
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

    public function municipio() {
         return $this->hasOne(municipio::class, 'id_municipio','id_municipio');
    }

}
