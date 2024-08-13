<?php

namespace App\Models\catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emergencias extends Model
{
    use HasFactory;
    protected $table = "tipo_emergencia";
    protected $primaryKey = 'id_tipo_emergencia';
    protected $fillable = [
        'id_tipo_emergencia',
        'descripcion',
        'activo'
    ];
}
