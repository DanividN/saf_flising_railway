<?php

namespace App\Models\funciones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siniestro extends Model
{
    use HasFactory;

    protected $table = "siniestros";
    protected $primaryKey = 'id_siniestro';

    protected $fillable = [
        'nombre',
        'activo'
    ];
}
