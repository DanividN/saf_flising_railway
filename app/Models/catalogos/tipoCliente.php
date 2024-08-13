<?php

namespace App\Models\catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipoCliente extends Model
{
    use HasFactory;

    protected $table = 'tipo_cliente';
    protected $fillable = [
        'id_tipo',
        'descripcion'
    ];
}
