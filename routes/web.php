<?php

use App\Http\Controllers\configuracion\UsuarioController;
use App\Http\Middleware\CheckIfPasswordNeedsReset;
use App\Http\Middleware\EnsureUserIsAdminApp;
use App\Http\Middleware\EnsureUserIsAdminOrCall;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('welcome');
})->name('home')->middleware('auth', EnsureUserIsAdminOrCall::class);

// require 'auth.php';

Route::middleware([CheckIfPasswordNeedsReset::class, 'auth', EnsureUserIsAdminOrCall::class])->group(function () {
    /*VISTAS DISEÑO*/
    require 'layout/app.php';
    require 'vistas/vistas.php';

    /*CONTROLADORES*/
    require 'configuracion/cliente.php';
    require 'configuracion/agenciaTalleres.php';
    require 'configuracion/garantia.php';
    require 'configuracion/aseguradora.php';
    require 'configuracion/gps.php';
    require 'configuracion/usuario.php';
    require 'administracion/asignacionUnidades.php';
    require 'administracion/garantiaFlising.php';

    /*RUTAS DE ADMINISTRACION*/
    require 'administracion/supervision.php';
    require 'administracion/autorizacionMantenimiento.php';
    require 'administracion/mantenimientosFlising.php';
    
    /*CONTROLADORES*/
    require 'configuracion/cliente.php';
    require 'configuracion/unidad.php';
    require 'configuracion/agenciaTalleres.php';
    require 'configuracion/garantia.php';
    require 'configuracion/aseguradora.php';
    require 'configuracion/gps.php';
    require 'configuracion/usuario.php';
    require 'administracion/asignacionUnidades.php';
    require 'administracion/garantiaFlising.php';
    require 'visor_maps/visor.php';

    require 'funciones/verificacion.php';



    /*RUTAS DE ADMINISTRACION*/
    require 'administracion/supervision.php';
    require 'administracion/asignacionPolizas.php';

    require 'funciones/verificacion.php';
    require 'funciones/mantenimiento_call.php';

    require 'administracion/tenencias.php';

    /*RUTAS DE ADMINISTRACION*/
    require 'administracion/supervision.php';
    require 'administracion/asignacionPolizas.php';
    require 'administracion/emergencias.php';

    /*RUTAS DE FUNCiOneS*/
    require 'funciones/emergencias_call.php';

    require 'funciones/verificacion.php';
    require 'funciones/mantenimiento_call.php';
    require 'funciones/garantia.php';

    require 'administracion/unidadTenencia.php';
    require 'administracion/tenencias.php';
    require 'funciones/asignacionSiniestros.php';

    /*RUTAS DE ADMINISTRACION*/
    require 'administracion/supervision.php';
    require 'administracion/asignacionPolizas.php';

    Route::post('/emergencias/{id_asignacion_emergencia}/messages', [MessageController::class, 'store'])->name('messages.store');
});

Route::middleware([CheckIfPasswordNeedsReset::class, EnsureUserIsAdminApp::class, 'auth'])->group(function () {
    require 'pwa.php';

    Route::get('/offline', function () {
        return view('vendor.laravelpwa.offline');
    });
});

Auth::routes();
Route::patch('configuracion/usuarios/cambiar/password/{usuario}', [UsuarioController::class, 'cambiarPassword'])->name('usuarios.cambiar.password')->middleware('auth');

