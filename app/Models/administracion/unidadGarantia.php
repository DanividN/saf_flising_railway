<?php

namespace App\Models\administracion;

use App\Models\configuracion\unidad;
use Illuminate\Database\Eloquent\Model;
use App\Models\administracion\asignacionUnidad;
use App\Models\configuracion\garantiasProveedores;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\configuracion\garantia\garantiaFlisingExtendida;

class unidadGarantia extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'unidad_garantias';
    protected $fillable = [
        'id_unidad',
        'id_garantia_proveedor',
        'id_asignacion_unidad',
        'tipo',
        'fecha_inicial',
        'fecha_final',
        'evento_asignado',
        'status'
    ];


    public function garantiaProveedor(): HasOne
    {
        return $this->hasOne(garantiasProveedores::class,'id_garantia_proveedor','id_garantia_proveedor');
    }

    public function unidad(){
        return $this->belongsTo(unidad::class, 'id_unidad', 'id_unidad');
    }
    public function garantiasFlising(){
        return $this->belongsTo(garantiaFlisingExtendida::class,'id_garantia_proveedor','id_g_flising_extendidas');
    }
    public function arrendamiento(){
        return $this->belongsTo(asignacionUnidad::class,'id_asignacion_unidad','id_asignacion_unidad');
    }
    
}
