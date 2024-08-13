<?php

namespace App\Models\configuracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gps extends Model
{
    use HasFactory;

    protected $table = 'gps';

    protected $primaryKey = 'id_gps';

    protected $fillable = [
        'id_gps',
        'razon_gps',
        'nombre_gps',
        'telefono_gps',
        'rfc_gps' ,
        'correo_gps',
        'calle_gps',
        'n_exterior_gps',
        'colonia_gps',
        'id_municipio',
        'cp_gps',
        'observacion_gps',
        'activo',
    ];


    public function municipio()
    {
        return $this->belongsTo('App\Models\catalogos\municipio', 'id_municipio', 'id_municipio');
    }

    public function contacto_gps()
    {
        return $this->belongsTo('App\Models\catalogos\contactos', 'id', 'id_gps');
    }
}
