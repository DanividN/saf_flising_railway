<?php

namespace App\Models\catalogos;

use App\Models\configuracion\aseguradora;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contactos extends Model
{
    use HasFactory;
    protected $table = 'contactos_servicios';
    protected $primaryKey = 'id_contacto';
    protected $foreingKey = 'id';
    protected $fillable = [
        'id_contacto',
        'nombre_contacto',
        'correo_contacto',
        'numero_contacto',
        'id',
        'tipo_contacto'
    ];

    public function aseguradora() {
        return $this->belongsTo(aseguradora::class, 'aseguradora_id', 'id');
    }
}
