<?php

namespace App\Models\catalogos;

use App\Models\configuracion\unidad;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class estado extends Model
{
    use HasFactory;
    protected $table = 'estados';
    protected $primaryKey = 'id_estado';
    public $timestamps = false;

    protected $fillable = [
        'nombre_estado',
        'tipo',
        'accion'
    ];


    public function unidades(): HasMany
    {
        return $this->hasMany(unidad::class,'id_estado','id_estado');
    }
}
