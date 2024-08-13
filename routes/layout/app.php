<?php

use Illuminate\Support\Facades\Route;


Route::get('/app', function() {
    return view('layouts/app');
});

Route::get('/', function() {
    return view('vista');
});

Route::get('notificaciones', function(){
    return view('notificaciones.index');
})->name('notificaciones');