<?php

namespace App\Models\catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class polizaSeguro extends Model
{
    use HasFactory;
    protected $table = 'poliza_seguros';
    protected $primaryKey = 'id_poliza_seguro';
    protected $fillable = [
        'id_poliza_seguro',
        'id_aseguradora',
        'nombre_poliza',
        'dano_material',
        'robo_total',
        'a_poliza',
        'activo',
    ];
}
