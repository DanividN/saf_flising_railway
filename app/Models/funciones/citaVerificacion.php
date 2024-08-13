<?php

namespace App\Models\funciones;

use App\Models\administracion\asignacionUnidad;
use App\Models\catalogos\municipio;
use App\Models\catalogos\verificentro;
use App\Models\configuracion\unidad;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class citaVerificacion extends Model
{
    use HasFactory;
    protected $table = "citas_verificaciones";
    protected $primaryKey = 'id_citas_verificaciones';

    protected $fillable = [
        'id_citas_verificaciones',
        'id_asignacion_unidad',
        'id_municipio',
        'id_verificentro',
        'id_unidad',
        'fecha_hora_verificacion',
        'a_cita',
        'estado',
    ];

    protected static function booted()
    {
        static::created(function ($cita) {
            $cita->load('Verificentro', 'arrendamiento.Responsable');
            if($cita->arrendamiento->activo=='1')
            Mail::send('funciones.verificaciones.mails.cita', ['cita' => $cita], function ($message) use ($cita) {
                $message->to($cita->arrendamiento->Responsable->correo_responsable);
                $message->subject('AGENDA DE VERIFICACIÓN');
                $message->attach(storage_path('app/public/' . $cita->a_cita));
            });
        });
    }


    public function Seguimiento()
    {
        return $this->hasOne(seguimientoVerificacion::class, 'id_citas_verificaciones', 'id_citas_verificaciones');
    }
    public function arrendamiento()
    {
        return $this->hasOne(asignacionUnidad::class, 'id_asignacion_unidad', 'id_asignacion_unidad');
    }
    public function Unidad()
    {
        return $this->belongsTo(unidad::class, 'id_unidad');
    }
    public function Municipio()
    {
        return $this->belongsTo(municipio::class, 'id_municipio');
    }
    public function Verificentro()
    {
        return $this->belongsTo(verificentro::class, 'id_verificentro', 'id_verificentro');
    }
}
