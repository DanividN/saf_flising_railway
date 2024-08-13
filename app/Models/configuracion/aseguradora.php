<?php

namespace App\Models\configuracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aseguradora extends Model
{
    use HasFactory;

    protected $table = 'aseguradoras';

    protected $primaryKey = 'id_aseguradora';

    protected $fillable = [
        'id_aseguradora',
        'razon_aseguradora',
        'nombre_aseguradora',
        'telefono_aseguradora',
        'rfc_aseguradora',
        'correo_aseguradora',
        'calle_aseguradora',
        'n_exterior_aseguradora',
        'colonia_aseguradora',
        'id_municipio',
        'cp_aseguradora',
        'activo',
        'created_at',
        'updated_at',
    ];

     // Relación con Municipio
    public function municipio()
    {
        return $this->belongsTo('App\Models\catalogos\municipio', 'id_municipio', 'id_municipio');
    }

    public function contacto_aseguradora()
    {
        return $this->belongsTo('App\Models\catalogos\contactos', 'id', 'id_aseguradora');
    }
}
