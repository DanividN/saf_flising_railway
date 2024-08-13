<?php

namespace App\Http\View\Composers;

use Carbon\Carbon;
use Illuminate\View\View;
use App\Models\administracion\unidadGarantia;

class NotificationGarantiaComposer {

    public function compose(View $view) {
        
        // $fechaEstatica = '2024-08-22';
        $fechaActual = Carbon::now();
        // $fechaActual = Carbon::parse($fechaEstatica);
        $fechaNotificacion = $fechaActual->copy()->addDays(15);
      
        $garantias = unidadGarantia::select('id_unidad', 'id_garantia_proveedor', 'fecha_final')
        ->where('tipo', 'GARANTIAS EXTENDIDAS FLISING')
        ->where('status', 1)    
        ->whereNotNull('fecha_final')
        ->where('fecha_final', '<=', $fechaNotificacion)
        ->where('fecha_final', '>', $fechaActual)
        ->get();
        
        // dd($garantias);

        $contadorGarantias = $garantias->count();
        
        $view->with('garantiasN', $garantias);
        $view->with('contadorGarantias', $contadorGarantias); 
        
     
    }
}