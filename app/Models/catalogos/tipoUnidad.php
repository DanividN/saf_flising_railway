<?php

namespace App\Models\catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipoUnidad extends Model
{
    use HasFactory;
    protected $table = "tipo_unidad";
    protected $primaryKey = 'id_tipo_unidad';

    protected $fillable = [
        'descripcion',
    ];
}
