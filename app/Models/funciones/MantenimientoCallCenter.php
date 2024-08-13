<?php

namespace App\Models\funciones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB; 
use App\Models\administracion\asignacionUnidad;
use App\Models\administracion\asignacionPoliza;
use App\Models\configuracion\unidad;
use App\Models\configuracion\cliente;
use App\Models\configuracion\agenciasTalleres;
use App\Models\configuracion\responsable;
use App\Models\catalogos\marca;
use App\Models\catalogos\tipoUnidad;
use App\Models\catalogos\polizaSeguro;

class MantenimientoCallCenter extends Model
{
    use HasFactory;
    protected $table = "citas_mantenimiento";
    public $primaryKey = 'id_citas_mantenimiento';
    protected $fillable = [
        'id_municipio',
        'id_proveedor',
        'id_unidad',
        'tipo_mantenimiento',
        'fecha_mantenimiento',
        'hora_mantenimiento',
        'a_cita_mantenimiento',
        'estado'
    ];

    public static function getClientes($id_user){
        $clientes = DB::table('usuario_clientes')
        ->select(
            'id_cliente'
        )
        ->where('id_usuario', $id_user)
        ->get();
        return $clientes;
    }

    public static function getUnidades($id_clientes){
        foreach($id_clientes as $key => $cliente){
            $clientes[$key] = DB::table('asignacion_unidades')
            ->join('unidades','unidades.id_unidad','asignacion_unidades.id_unidad')
            ->join('clientes','clientes.id_cliente','asignacion_unidades.id_cliente')
            ->join('marca','marca.id_marca','unidades.id_marca')
            ->join('years','years.id_year','unidades.year')
            ->leftjoin('citas_mantenimiento','citas_mantenimiento.id_unidad','unidades.id_unidad')
            ->leftjoin('seguimiento_mantenimiento','seguimiento_mantenimiento.id_citas_mantenimiento','citas_mantenimiento.id_citas_mantenimiento')
            ->select(
                'asignacion_unidades.placas',
                'asignacion_unidades.placas',
                'marca.descripcion as marca',
                'unidades.id_unidad as unidad_id',
                'unidades.modelo',
                'years.descripcion as anio',
                DB::RAW('MIN(citas_mantenimiento.estado)as status_mantenimiento'),
                DB::RAW('MIN(seguimiento_mantenimiento.estatus_pago)as estatus_pago'),
                'clientes.nombre_cliente',
                'clientes.telefono_cliente'
            )
            ->where('asignacion_unidades.id_cliente', $cliente->id_cliente)
            ->where('asignacion_unidades.activo',1)
            ->groupBy('asignacion_unidades.id_unidad')
            ->get();
        }
        return $clientes;
    }

    public static function getMantenimientos($unidades){
        foreach($unidades as $key => $unidad){
            //dd($unidades);
            $mantenimiento[$key] = DB::table('citas_mantenimiento')
            ->select('*')
            // ->where('citas_mantenimiento.id_unidad', $unidad->unidad_id)
            ->orderBy('citas_mantenimiento.id_citas_mantenimiento', 'DESC')
            ->limit(1)
            ->get();
        }
        return $mantenimiento;
    }

    public static function getEntidad(){
        $entidad = DB::table('entidades_federativas')
        ->select('*')
        ->get();
        return $entidad;
    }

    public static function getProveedores($id_municipio){
        $proveedor = DB::table('proveedores')->select('*')->where('id_municipio', $id_municipio)->get();
        return $proveedor;
    }

    public static function getProveedoresDir($id_proveedor){
        $direccion = DB::table('proveedores')->select('direccion_proveedor')->where('id_proveedor', $id_proveedor)->get();
        return $direccion;
    }
    public static function getFechaMantenimiento($id_unidad){
        $fecha_mant = DB::table('unidades')->select('fecha_mantenimiento')->where('id_unidad', $id_unidad)->get();
        return $fecha_mant;
    }

    public static function getPendientes($unidad_id){
        $count = DB::table('citas_mantenimiento')
        ->select('id_unidad')
        ->where('estado', 'PENDIENTE')
        ->orWhere('estado', 'AUTORIZADO')
        ->orWhere('estado', 'AGENDADO')
        ->where('id_unidad', $unidad_id)
        ->count();
        return $count;
    }

    public static function getInfoUnidad($unidad_id){
        $info_unidad = DB::table('asignacion_unidades')
        ->join('unidades', 'unidades.id_unidad', 'asignacion_unidades.id_unidad')
        ->join('marca','marca.id_marca', 'unidades.id_marca')
        ->join('clientes','clientes.id_cliente', 'asignacion_unidades.id_cliente')
        ->join('responsables','responsables.id_responsable', 'asignacion_unidades.id_responsable')
        ->select(
            'asignacion_unidades.id_asignacion_unidad',
            'unidades.vehiculo_id as idUnidad',
            'marca.descripcion as marca',
            'asignacion_unidades.placas',
            'clientes.nombre_cliente as cliente',
            'responsables.nombre_responsable',
            'responsables.cargo',
            'responsables.telefono_responsable',
        )
        ->where('asignacion_unidades.id_unidad', $unidad_id)
        ->where('asignacion_unidades.activo', 1)
        ->get();
        return $info_unidad;
    }

    public function asignacion_unidad(){
        return $this->belongsTo(asignacionUnidad::class,'id_unidad','id_unidad');
    }

    public function unidad(){
        return $this->belongsTo(unidad::class,'id_unidad','id_unidad');
    }

    public function marcas(){
        return $this->belongsTo(marca::class,'id_marca','id_marca');
    }

    public function cliente(){
        return $this->belongsTo(cliente::class,'id_cliente','id_cliente');
    }

    public function seguimiento_mantenimiento(){
        return $this->hasOne(seguimientoMantenimiento::class,'id_citas_mantenimiento','id_citas_mantenimiento');
    }

    public function proveedor(){
        return $this->belongsTo(agenciasTalleres::class,'id_proveedor','id_proveedor');
    }

    public function responsable(){
        return $this->belongsTo(responsable::class,'id_responsable','id_responsable');
    }

    public function tipo_unidad(){
        return $this->belongsTo(tipoUnidad::class,'id_tipo_unidad','id_tipo_unidad');
    }

    public function poliza(){
        return $this->belongsTo(asignacionPoliza::class,'id_unidad','id_unidad')->where('activo',1);
    }
}
