<?php

namespace App\Models\administracion;

use App\Models\catalogos\estado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class detalleAsignacion extends Model
{
    use HasFactory;
    protected $table = 'detalle_asignacion';
    protected $primaryKey = 'id_detalle';

    protected $fillable = [
        'id_asignacion_unidad',
        'id_estado',
    ];


    public function estado(): BelongsTo
    {
        return $this->belongsTo(estado::class,'id_estado','id_estado');
    }

}
