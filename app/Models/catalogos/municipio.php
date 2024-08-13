<?php

namespace App\Models\catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class municipio extends Model
{
    use HasFactory;
    protected $table ='municipios';
    public $primaryKey = 'id_municipio';
    protected $fillable = [
        'id_entidad_federativa',
        'nombre_municipio',
    ];

    public function verificentros(): HasMany
    {
        return $this->hasMany(verificentro::class,'id_municipio', 'id_municipio');
    }
}
