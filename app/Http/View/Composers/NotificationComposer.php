<?php

namespace App\Http\View\Composers;

use App\Models\administracion\CitaSupervision;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NotificationComposer
{
    public function compose(View $view) {
        $notificationCount = CitaSupervision::where('mostrar_notificacion', '1')->where('id_usuario', Auth::id())->count();
        
        $view->with('notificationCount', $notificationCount);
    }
}