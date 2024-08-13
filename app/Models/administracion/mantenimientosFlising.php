<?php

namespace App\Models\administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class mantenimientosFlising extends Model
{
    use HasFactory;
    protected $table = 'asignacion_unidades';
    public $primaryKey = 'id_asignacion_unidad';
}
