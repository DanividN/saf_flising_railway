<?php

namespace App\Http\Controllers\configuracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsuarioRequest;
use App\Models\configuracion\UsersCliente;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller {
    public function index() {
        $usuarios = User::with('roles')->get();
        return view('configuracion.usuarios.index')->with(compact('usuarios'));
    }

    public function create() {
        $usuario = new User();
        $clientes = DB::table('clientes')->get();
        return view('configuracion.usuarios.create')->with(compact('usuario', 'clientes'));
    }

    public function store(UsuarioRequest $request) {
        try {
            DB::beginTransaction();
                $caracteres = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ$_'), 0, 8);
                $contraseña = strtoupper('SAF_'. $caracteres . '_' . Carbon::now()->format('Y'));

                $usuario = new User();
                $datos = $request->validated();
                $datos['password'] = bcrypt($contraseña);
                $datos['vip'] = $request->has('vip') ? 1 : 0;
                $usuario->fill($datos);
                $usuario->save();

                if ($request->tipo_usuario == User::CALLCENTER && !empty($request->clientes_asignado)) {
                    $clientesAsignados = collect($request->clientes_asignado)->map(function ($cliente) use ($usuario) {
                        return ['id_usuario' => $usuario->id, 'id_cliente' => $cliente];
                    });
                    UsersCliente::insert($clientesAsignados->toArray());
                }

                $usuario->assignRole($request->roles);  
                $usuario->givePermissionTo($request->permisos);

                Mail::send('configuracion.usuarios.newPassword', ['name' => $request->name, 'password' => $contraseña, 'email' => $request->email], function ($message) use ($request) {
                    $message->to($request->email)->subject('Contraseña de acceso');
                    $message->from('plataforma.flising09@gmail.com', 'Sistema de Administración de Flotillas');
                });
            DB::commit();
            
            return redirect()->route('usuarios.index')->with('success', 'Usuario guardado correctamente');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Ocurrió un error al guardar el usuario');
        }
    }

    public function edit(User $usuario) {
        $clientes = DB::table('clientes')->get();
        $usuarioClientes = $usuario->usuarioClientes->pluck('id_cliente')->toArray();

        $roles = $usuario->getRoleNames();
        $permisos = $usuario->permissions()->pluck('name')->toArray();
        
        return view('configuracion.usuarios.edit')->with(compact('usuario', 'clientes', 'usuarioClientes','roles','permisos'));
    }

    public function update(UsuarioRequest $request, User $usuario) {
        try {
            DB::beginTransaction();
                $datos = $request->validated();
                $datos['vip'] = $request->has('vip') ? 1 : 0;
                $usuario->fill($datos);
                $usuario->save();

                if($usuario->tipo_usuario == User::CALLCENTER) {
                    $clientesAsignados = collect($request->clientes_asignado)->map(function ($cliente) use ($usuario) {
                        return ['id_usuario' => $usuario->id, 'id_cliente' => $cliente];
                    });
                    UsersCliente::where('id_usuario', $usuario->id)->delete();
                    UsersCliente::insert($clientesAsignados->toArray());
                }

                $usuario->syncRoles($request->roles);
                $usuario->syncPermissions($request->permisos);
            DB::commit();

            return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Ocurrió un error al actualizar el usuario');
        }
    }

    public function obtenerPermisos($tipo_usuario) {
        $rolesWithPermissions = Role::with('permissions')->get();

        if ($tipo_usuario == User::CALLCENTER) {
            $rolesWithPermissions = $rolesWithPermissions->filter(function ($role) {
                return $role->name == 'funciones';
            })->values()->toArray();
        }
        
        return response()->json($rolesWithPermissions);
    }

    public function reestablecerPassword(User $usuario) {
        try {
            DB::beginTransaction();
                $caracteres = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ$_'), 0, 8);
                $contraseña = strtoupper('SAF_'. $caracteres . '_' . Carbon::now()->format('Y'));
                $usuario->validado = 0;
                $usuario->password = bcrypt($contraseña);
                $usuario->save();
        
                Mail::send('configuracion.usuarios.newPassword', ['name' => $usuario->name, 'password' => $contraseña, 'email' => $usuario->email], function ($message) use ($usuario) {
                    $message->to($usuario->email)->subject('Contraseña de acceso');
                    $message->from('plataforma.flising09@gmail.com', 'Sistema de Administración de Flotillas');
                });
            DB::commit();
    
            return back()->with('success', 'Contraseña reestablecida correctamente');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Ocurrió un error al reestablecer la contraseña');
        }
    }

    public function cambiarPassword(Request $request, User $usuario) {
        $request->validate([
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ]);
        
        try {
            DB::beginTransaction();
                
                $usuario->password = bcrypt($request->password);
                $usuario->validado = 1;
                $usuario->save();

                session(['needs_to_reset_password' => false]);
            DB::commit();

            return back()->with('success', 'Contraseña actualizada correctamente');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Ocurrió un error al cambiar la contraseña, recargue la página e intente de nuevo');
        }
    }
}

// FlisingSaf$98