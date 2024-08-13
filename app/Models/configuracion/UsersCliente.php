<?php

namespace App\Models\configuracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\administracion\asignacionUnidad;

class UsersCliente extends Model
{
    use HasFactory;

    protected $table = 'usuario_clientes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'id_cliente',
        'id_usuario',
        'created_at',
        'updated_at'
    ];
    protected $guarded = [];

    public function unidades(){
        return $this->belongsTo(asignacionUnidad::class, 'id_cliente', 'id_cliente');
    }
}
