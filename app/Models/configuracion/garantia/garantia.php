<?php

namespace App\Models\configuracion\garantia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class garantia extends Model
{
    use HasFactory;
    
    protected $table = "garantias_flising";
    protected $primaryKey = 'id_g_flising';
    
    protected $fillable = [
        'id_g_flising',
        "razon_social",
        "nombre_comercial",
        "telefono_g_flising",
        "rfc_g_flising",
        "correo_g_flising",
        "calle_g_flising",
        "n_exterior_g_flising",
        "colonia_g_flising",
        "id_municipio",
        "cp_g_flising",
        "activo",
    ];
}
