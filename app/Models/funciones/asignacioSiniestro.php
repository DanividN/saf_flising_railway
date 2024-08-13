<?php

namespace App\Models\funciones;

use App\Models\administracion\asignacionPoliza;
use App\Models\administracion\asignacionUnidad;
use App\Models\configuracion\cliente;
use App\Models\configuracion\unidad;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asignacioSiniestro extends Model
{
    use HasFactory;

    protected $table = "asignacion_siniestros";
    protected $primaryKey = 'id_asignar_siniestro';

    protected $fillable = [
        'id_cliente',
        'id_unidad',
        'id_siniestro',
        'id_poliza_seguro',
        'fecha_siniestro',
        'a_evidencia_siniestro',
        'observaciones',
        'created_at',
        'update_at'
    ];

    function cliente() {
        return $this->hasOne(cliente::class,'id_cliente','id_cliente');
    }

    function unidad() {
        return $this->belongsTo(unidad::class,'id_unidad');
    }

    function polizaSeguro() {
        return $this->hasOne(asignacionPoliza::class, 'id_asignacion_seguros', 'id_poliza_seguro');
    }
    function siniestros() {
        return $this->hasOne(siniestro::class,'id_siniestro','id_siniestro');
    }
}
