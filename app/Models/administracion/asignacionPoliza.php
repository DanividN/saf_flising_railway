<?php

namespace App\Models\administracion;

use App\Models\catalogos\polizaSeguro;
use App\Models\configuracion\aseguradora;
use App\Models\configuracion\gps;
use App\Models\configuracion\unidad;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asignacionPoliza extends Model
{
    use HasFactory;
    protected $table = 'asignacion_seguros';
    protected $primaryKey = 'id_asignacion_seguros';
    protected $fillable = [
        'id_asignacion_seguros',
        'id_unidad',
        'id_aseguradora',
        'id_poliza_seguro',
        'id_gps',
        'fecha_pago',
        'monto_seguro',
        'monto_deducible_seguro',
        'n_poliza',
        'fecha_inicio',
        'fecha_vencimiento',
        'adicional_poliza',
        'a_evidencia',
        'a_poliza',
        'activo'
    ];

    public function unidad() {
        return $this->hasOne(unidad::class,'id_unidad','id_unidad');
    }
    public function polizas() {
        return $this->hasOne(polizaSeguro::class,'id_poliza_seguro','id_poliza_seguro');
    }
    public function gps() {
        return $this->hasOne(gps::class,'id_gps','id_gps');
    }

    public function aseguradora(){
        return $this->hasOne(aseguradora::class, 'id_aseguradora', 'id_aseguradora');
    }
}



