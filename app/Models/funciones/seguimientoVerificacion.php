<?php

namespace App\Models\funciones;

use App\Models\catalogos\holograma;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class seguimientoVerificacion extends Model
{
    use HasFactory;
    protected $table = "seguimiento_verificacion";
    protected $primaryKey = 'id_citas_verificaciones';

    protected $fillable = [
        'id_citas_verificaciones',
        'id_holograma',
        'periodo',
        'fecha_verificacion',
        'monto_verificacion',
        'year_verificacion',
        'a_evidencia_verificacion',
        'multa_verificacion',
        'monto_multa',
        'a_comprobante_multa',
        'descripcion',
    ];

    protected static function booted()
    {
        static::creating(function ($seguimiento) {
            $seguimiento->load('Cita.arrendamiento.Responsable', 'Cita.Unidad');
            if($seguimiento->cita->arrendamiento->activo=='1')
            Mail::send('funciones.verificaciones.mails.seguimiento', ['seguimiento' => $seguimiento], function ($message) use ($seguimiento) {
                $message->to($seguimiento->Cita->arrendamiento->Responsable->correo_responsable);
                $message->subject('AGENDA DE VERIFICACIÓN');
            });
        });
    }

    public function Cita()
    {
        return $this->belongsTo(citaVerificacion::class,'id_citas_verificaciones','id_citas_verificaciones');
    }
    public function Holograma()
    {
        return $this->belongsTo(holograma::class,'id_holograma','id_holograma');
    }

}
