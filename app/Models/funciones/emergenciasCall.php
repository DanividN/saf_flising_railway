<?php

namespace App\Models\funciones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class emergenciasCall extends Model
{
    use HasFactory;

    protected $table = 'asignacion_emergencia';
    protected $primaryKey = 'id_asignacion_emergencia';
    protected $fillable = [
        'id_asignacion_emergencia',
        'id_cliente',
        'id_responsable',
        'id_asignacion_unidad',
        'id_tipo_emergencia',
        'descripcion_emergencia',
        'estado_emergencia'
    ];

    public static function getClientes($id_user){
        $clientes = DB::table('usuario_clientes')
        ->join('clientes', 'clientes.id_cliente', '=', 'usuario_clientes.id_cliente')
        ->select(
            'clientes.id_cliente',
            'clientes.nombre_cliente'
        )
        ->where('id_usuario', $id_user)
        ->get();
        return $clientes;
    }

    public static function getUnidadesEmergencia($id_user){
        $emergencia = DB::table('asignacion_emergencia')
            ->join('clientes', 'clientes.id_cliente', '=', 'asignacion_emergencia.id_cliente')
            ->join('usuario_clientes', 'usuario_clientes.id_cliente', '=', 'clientes.id_cliente')
            ->join('responsables','responsables.id_responsable', '=', 'asignacion_emergencia.id_responsable')
            ->join('asignacion_unidades', 'asignacion_unidades.id_asignacion_unidad', '=', 'asignacion_emergencia.id_asignacion_unidad')
            ->join('unidades', 'unidades.id_unidad', '=', 'asignacion_unidades.id_unidad')
            ->leftJoin('asignacion_seguros', function ($join) {
                $join->on('asignacion_seguros.id_unidad', '=', 'unidades.id_unidad')
                    ->where('asignacion_seguros.id_asignacion_seguros', '=', function($query) {
                        $query->selectRaw('MAX(id_asignacion_seguros)')
                            ->from('asignacion_seguros')
                            ->whereColumn('id_unidad', 'unidades.id_unidad');
                    });
            })
            ->leftJoin('aseguradoras', 'aseguradoras.id_aseguradora', '=', 'asignacion_seguros.id_aseguradora')
            ->select(
                'clientes.nombre_cliente',
                'responsables.nombre_responsable',
                'unidades.modelo',
                'asignacion_unidades.placas',
                'aseguradoras.nombre_aseguradora',
                'asignacion_emergencia.estado_emergencia',
                'asignacion_unidades.id_asignacion_unidad'
            )
            ->where('asignacion_unidades.activo', 1)
            ->whereIn('asignacion_emergencia.id_asignacion_emergencia', function($query) {
                $query->selectRaw('MAX(id_asignacion_emergencia)')
                    ->from('asignacion_emergencia')
                    ->groupBy('id_asignacion_unidad');
            })
            ->where('usuario_clientes.id_usuario', $id_user)
            ->orderBy('asignacion_emergencia.created_at', 'desc')
            ->get();
        return $emergencia;
    }

    public static function getEmergencia($emergencia){
        $data = DB::table('asignacion_emergencia')
            ->join('clientes', 'clientes.id_cliente', '=', 'asignacion_emergencia.id_cliente')
            ->join('responsables','responsables.id_responsable', '=', 'asignacion_emergencia.id_responsable')
            ->join('asignacion_unidades', 'asignacion_unidades.id_asignacion_unidad', '=', 'asignacion_emergencia.id_asignacion_unidad')
            ->join('unidades', 'unidades.id_unidad', '=', 'asignacion_unidades.id_unidad')
            ->join('marca', 'marca.id_marca', '=', 'unidades.id_marca')
            ->leftJoin('asignacion_seguros', function ($join) {
                $join->on('asignacion_seguros.id_unidad', '=', 'unidades.id_unidad')
                    ->where('asignacion_seguros.id_asignacion_seguros', '=', function($query) {
                        $query->selectRaw('MAX(id_asignacion_seguros)')
                            ->from('asignacion_seguros')
                            ->whereColumn('id_unidad', 'unidades.id_unidad');
                    });
            })
            ->leftJoin('aseguradoras', 'aseguradoras.id_aseguradora', '=', 'asignacion_seguros.id_aseguradora')
            ->select(
                'clientes.nombre_cliente',
                'responsables.nombre_responsable',
                'responsables.cargo',
                'responsables.telefono_responsable',
                'unidades.modelo',
                'unidades.vehiculo_id',
                'marca.descripcion as marca',
                'asignacion_unidades.placas',
                'aseguradoras.nombre_aseguradora',
                'asignacion_emergencia.estado_emergencia',
                'asignacion_unidades.id_asignacion_unidad',
                'asignacion_emergencia.created_at',
                'asignacion_emergencia.id_asignacion_emergencia',
            )
            ->where('asignacion_emergencia.id_asignacion_unidad', $emergencia)
            ->where('asignacion_unidades.activo', 1)
            ->get();
        return $data;
    }

    public static function showEmergencia($emergencia){
        $data = DB::table('asignacion_emergencia')
            ->join('tipo_emergencia', 'tipo_emergencia.id_tipo_emergencia', '=', 'asignacion_emergencia.id_tipo_emergencia')
            ->join('clientes', 'clientes.id_cliente', '=', 'asignacion_emergencia.id_cliente')
            ->join('responsables','responsables.id_responsable', '=', 'asignacion_emergencia.id_responsable')
            ->join('asignacion_unidades', 'asignacion_unidades.id_asignacion_unidad', '=', 'asignacion_emergencia.id_asignacion_unidad')
            ->join('unidades', 'unidades.id_unidad', '=', 'asignacion_unidades.id_unidad')
            ->join('marca', 'marca.id_marca', '=', 'unidades.id_marca')
            ->leftJoin('asignacion_seguros', function ($join) {
                $join->on('asignacion_seguros.id_unidad', '=', 'unidades.id_unidad')
                    ->where('asignacion_seguros.id_asignacion_seguros', '=', function($query) {
                        $query->selectRaw('MAX(id_asignacion_seguros)')
                            ->from('asignacion_seguros')
                            ->whereColumn('id_unidad', 'unidades.id_unidad');
                    });
            })
            ->leftJoin('aseguradoras', 'aseguradoras.id_aseguradora', '=', 'asignacion_seguros.id_aseguradora')
            ->leftJoin('poliza_seguros', 'poliza_seguros.id_poliza_seguro', '=', 'asignacion_seguros.id_poliza_seguro')
            ->leftJoin('gps', 'gps.id_gps', '=', 'asignacion_seguros.id_gps')
            ->select(
                'clientes.nombre_cliente',
                'tipo_emergencia.descripcion as emergencia',
                'responsables.nombre_responsable',
                'responsables.cargo',
                'responsables.telefono_responsable',
                'unidades.modelo',
                'unidades.n_motor',
                'unidades.vehiculo_id',
                'marca.descripcion as marca',
                'asignacion_unidades.placas',
                'gps.nombre_gps',
                'aseguradoras.nombre_aseguradora',
                'poliza_seguros.nombre_poliza',
                'asignacion_seguros.n_poliza',
                'asignacion_emergencia.*',
                'asignacion_unidades.id_asignacion_unidad'
            )
            ->where('asignacion_emergencia.id_asignacion_emergencia', $emergencia)
            ->where('asignacion_unidades.activo', 1)
            ->first();
        return $data;
    }

    public static function llamadaStore($data){
        $llamada = DB::table('llamadas_callcenter')
            ->insert([
                'modulo' => '1',
                'id_asignacion_unidad' => $data['id_asignacion_unidad'],
                'estatus' => $data['estatus'],
                'fecha' => $data['fecha'],
                'hora' => $data['hora'],
                'id_callcenter' => $data['id_callcenter'],
                'descripcion' => $data['descripcion']
            ]);

        return $llamada;
    }
}
