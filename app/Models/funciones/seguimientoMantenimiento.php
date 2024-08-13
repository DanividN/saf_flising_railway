<?php

namespace App\Models\funciones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\configuracion\unidad;
use App\Models\funciones\MantenimientoCallCenter;

class seguimientoMantenimiento extends Model
{
    use HasFactory;
    protected $table = "seguimiento_mantenimiento";
    public $primaryKey = "id_citas_mantenimiento";

    protected $fillable = [
        'id_citas_mantenimiento',
        'fecha_mantenimiento',
        'monto_mantenimiento',
        'tipo_mantenimiento',
        'a_cotizacion',
        'a_factura',
        'autorizacion',
        'observaciones_call',
        'observaciones_flising',
        'estatus_pago'
    ];

    public function citas_mantenimiento(){
        return $this->belongsTo(MantenimientoCallCenter::class, 'id_citas_mantenimiento');
    }

}
