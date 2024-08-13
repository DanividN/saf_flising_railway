<?php

use App\Http\Controllers\configuracion\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\configuracion')->middleware('auth')->prefix('configuracion')->group(function () {
    Route::get('usuarios/index', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
    Route::post('usuarios/store', [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::get('usuarios/edit/{usuario}', [UsuarioController::class, 'edit'])->name('usuarios.edit');
    Route::patch('usuarios/update/{usuario}', [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::get('usuarios/obtener/permisos/{tipo_usuario}', [UsuarioController::class, 'obtenerPermisos'])->name('usuarios.obtener.permisos');
    Route::patch('usuarios/reestablecer/password/{usuario}', [UsuarioController::class, 'reestablecerPassword'])->name('usuarios.restablecer.password');
});
