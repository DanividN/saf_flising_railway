<?php

namespace App\Models\configuracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class responsable extends Model
{
    use HasFactory;

    protected $table = 'responsables';
    public $primaryKey = 'id_responsable';


    protected $fillable = [
        'id_cliente',
        'nombre_responsable',
        'cargo',
        'telefono_responsable',
        'correo_responsable',
        'folio_ine',
        'vip',
        'numero_empleado',
        'a_ine_responsable',
        'activo',
        'created_at',
        'updated_at',
    ];

    public function cliente()
    {
        return $this->hasOne(cliente::class,'id_cliente', 'id_cliente');
    }
}
