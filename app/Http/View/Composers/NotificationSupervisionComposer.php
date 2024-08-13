<?php

namespace App\Http\View\Composers;

use App\Models\administracion\CitaSupervision;
use Illuminate\View\View;

class NotificationSupervisionComposer {

    public function compose(View $view) {
        $supervisiones = CitaSupervision::with('cliente', 'supervisor', 'unidad.tipo_unidad', 'asignacionUnidad', 'unidad.marca')  
            ->where('notificacion_citas', CitaSupervision::CONCLUIDA) 
            ->where('notificacion_web', '1')
            ->get();
        $supervisionesCount = CitaSupervision::where('notificacion_citas', CitaSupervision::CONCLUIDA)->where('notificacion_web', '1')->count();
        
        $view->with('supervisiones', $supervisiones)->with('supervisionesCount', $supervisionesCount);   
    }
}