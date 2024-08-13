<?php

namespace App\Models\administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervision extends Model {
    use HasFactory;

    protected $table = 'supervisiones';
    protected $primaryKey = 'id_citas_supervision';
    protected $fillable = [
        'id_citas_supervision',
        "talon_verificacion",
        "llave_repuesto",
        "gato_hidraulico",
        "triangulo_seguridad",
        "manual_usuario",
        "engomado",
        "placas_check",
        "poliza_mantenimiento",
        "llanta_refaccion",
        "poliza_seguro",
        "tarjeta_circulacion",
        "vida_util_llantas",
        "observacion_supervisor",
        "obsevaciones_vista_frontal",
        "obsevaciones_vista_izquierda",
        "obsevaciones_vista_trasera",
        "obsevaciones_vista_derecha",
        "img_firma_cliente", //firma
        "pills_frontal_superior_img",
        "pills_izquierda_superior_img",
        "pills_trasera_superior_img",
        "pills_derecha_superior_img",
        "evidecia_vista_frontal",
        "evidecia_vista_izquierda",
        "evidecia_vista_trasera",
        "evidecia_vista_derecha" 
    ];

    public function citaSupervision() {
        return $this->belongsTo(CitaSupervision::class, 'id_citas_supervision', 'id_citas_supervision');
    }
}