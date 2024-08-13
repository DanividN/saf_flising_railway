<?php

namespace App\Models\catalogos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class year extends Model
{
    use HasFactory;
    protected $table = 'years';
    public $primaryKey = 'id_year';

    protected $fillable = [
        'descripcion'
    ];

}
