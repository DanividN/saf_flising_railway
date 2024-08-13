<?php

namespace App\Models\catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class marca extends Model
{
    use HasFactory;
    protected $table = 'marca';
    public $primaryKey = 'id_marca';

    protected $fillable = [
        'descripcion'
    ];
}
