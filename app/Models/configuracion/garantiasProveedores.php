<?php

namespace App\Models\configuracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class garantiasProveedores extends Model
{
    use HasFactory;
    protected $table = "garantia_proveedores";
    public $primaryKey = "id_garantia_proveedor";

    protected $fillable = [
        'id_proveedor',
        'nombre_g_proveedor',
        'vigencia_g_proveedor',
        'monto_g_proveedor',
        'a_g_evidencia',
        'activo',
    ];
}
