<?php

namespace App\Models\configuracion\garantia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class garantiaFlisingExtendida extends Model
{
    use HasFactory;
    protected $table = 'garantias_flising_extendidas';
    protected $primaryKey = 'id_g_flising_extendidas';
    
    protected $fillable = [
        'id_g_flising_extendida',
        'id_g_flising',
        'nombre_g_extendida',
        'vigencia_g_extendida',
        'eventos_por_year',
        'monto_g_extendida',
        'a_evidencia_extendida',
        'descripcion_g_extendida',
        'activo',
    ];
}
