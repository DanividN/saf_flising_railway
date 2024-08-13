<?php

namespace App\Models\funciones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class callCenter extends Model
{
    use HasFactory;
    protected $table = "llamadas_callcenter";
    protected $primaryKey = 'id_llamadas';

    protected $fillable = [
        'modulo',
        'id_asignacion_unidad',
        'estatus',
        'tipo_llamada',
        'fecha',
        'hora',
        'id_callcenter',
        'descripcion',
        'created_at',
        'updated_at'
    ];
}
