<?php

namespace App\Models\catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class plazoArrendamiento extends Model
{
    use HasFactory;
    protected $table = 'plazo_arrendamientos';
    protected $primaryKey = 'id_plazo';

    protected $fillable = [
        'plazo',
    ];
}
