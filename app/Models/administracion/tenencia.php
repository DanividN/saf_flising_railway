<?php

namespace App\Models\administracion;

use App\Models\configuracion\unidad;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tenencia extends Model
{
    use HasFactory;

    protected $table = "tenencias";
    protected $primaryKey = 'id_tenencia';

    protected $fillable = [
        'id_unidad',
        'fecha_pago',
        'monto_tenencia',
        'a_evidencia_tenencia',
        'observacion',
        'arrendamiento_id',
        'created_at',
        'update_at'
    ];

    function unidad()
    {
        return $this->belongsTo(unidad::class,'id_unidad','id_unidad');
    }
    function arrendaminto() {
        return $this->hasOne(asignacionUnidad::class,'id_asignacion_unidad','arrendamiento_id');
    }

}
