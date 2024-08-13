<?php

// app/Models/Message.php
namespace App\Models;

use App\Models\funciones\emergenciasCall;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['id_asignacion_emergencia', 'user_id', 'message'];

    public function emergency()
    {
        return $this->belongsTo(emergenciasCall::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
