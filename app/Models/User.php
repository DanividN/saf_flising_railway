<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\configuracion\UsersCliente;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasPermissions;

    const ADMINISTRATIVO = 'ADMINISTRATIVO';
    const CALLCENTER = 'CALL_CENTER';
    const SUPERVISIONAPP = 'SUPERVISION_APP';
    const MATUTINO = 'MATUTINO';
    const VESPERTINO = 'VESPERTINO';
    const NOCTURNO = 'NOCTURNO';

    protected $fillable = [
        'name',
        'email',
        'tipo_usuario',
        'password',
        'vip',
        'validado',
        'turno'
    ];
        
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function usuarioClientes() {
        return $this->hasMany(UsersCliente::class, 'id_usuario', 'id');
    }
    
    public function permissions() {
        return $this->belongsToMany(Permission::class, 'model_has_permissions', 'model_id', 'permission_id');
    }
}
