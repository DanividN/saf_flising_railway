<?php

namespace App\Models\administracion;

use App\Models\configuracion\cliente;
use App\Models\configuracion\unidad;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitaSupervision extends Model
{
    use HasFactory;
    
    const AGENDADA = 'AGENDADA';
    const CANCELADA = 'CANCELADA';
    const CONCLUIDA = 'CONCLUIDA';
    const VENCIDA = 'VENCIDA';
    const VALIDADA = 'VALIDADA';

    protected $table = 'citas_supervision';
    protected $primaryKey = 'id_citas_supervision';
    protected $fillable = [
        'id_cliente',
        'id_usuario',
        'id_unidad',
        'fecha_supervision',
        'hora',
        'notificacion_citas',
        'mostrar_notificacion',
        'notificacion_web'
    ];

    public function cliente() {
        return $this->belongsTo(cliente::class, 'id_cliente', 'id_cliente');
    }

    public function supervisor() {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }

    public function unidad() {
        return $this->belongsTo(unidad::class, 'id_unidad', 'id_unidad');
    }

    public function supervision() {
        return $this->hasOne(Supervision::class, 'id_citas_supervision', 'id_citas_supervision');
    }

    public function asignacionUnidad() {
        return $this->belongsTo(asignacionUnidad::class, 'id_asignacion_unidad', 'id_asignacion_unidad');
    }
}