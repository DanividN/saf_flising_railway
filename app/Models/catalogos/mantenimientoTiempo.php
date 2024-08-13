<?php

namespace App\Models\catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mantenimientoTiempo extends Model
{
    use HasFactory;
    protected $table = "mantenimiento_tiempo";
    protected $primaryKey = 'id_mantenimiento_tiempo';

    protected $fillable = [
        'descripcion',
    ];
}
