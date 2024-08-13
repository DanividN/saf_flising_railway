<?php

namespace App\Http\View\Composers;

use App\Http\Controllers\funciones\verificacionController;
use App\Models\configuracion\unidad;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NotificationVerificacionComposer
{

    public function compose(View $view)
    {
        $contoller = new verificacionController();
        if (!Auth::user()) return;
        $verificacionesAlertas =
            unidad::with('UltimoArrendamiento', 'UltimaVerificacion.Seguimiento')->whereHas('UltimoArrendamiento', function ($q) {
                $q->where('activo', '1')->where('etapa', '>', 1);
            })->whereHas('UltimoArrendamiento.Cliente', function ($q) {
                $q->whereIn('id_cliente', Auth::user()->usuarioClientes->pluck('id_cliente'));
            })->whereHas('UltimoArrendamiento.Responsable', function ($q) {
                $q->where('vip', Auth::user()->vip);
            })->get()->filter(function ($unidad) use ($contoller) {
                $unidad->estado = $contoller->getEstado($unidad);
                return ($unidad->estado[0] == 'PENDIENTE' || $unidad->estado[0] == 'VENCIDO');
            })->groupBy('UltimoArrendamiento.terminacion_placas')->map(function ($unidad) {
                return (object)['unidades' => count($unidad), 'estado' => $unidad->pluck('estado')->flatten()];
            });
            
        $verificacionesCount = $verificacionesAlertas->sum(function ($obj) {
            return $obj->unidades;
        });

        $view->with('verificacionesAlertas', $verificacionesAlertas)->with('verificacionesCount', $verificacionesCount);
    }
}
