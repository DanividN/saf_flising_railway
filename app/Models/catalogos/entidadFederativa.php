<?php

namespace App\Models\catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class entidadFederativa extends Model
{
    use HasFactory;

    protected $table = "entidades_federativas";
    public $primaryKey = 'id_entidad_federativa';
    protected $fillable = [
        "nombre_entidad_federativa",
    ];
}
