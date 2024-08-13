<?php

namespace App\Http\View\Composers;

use App\Models\administracion\tenencia;
use Illuminate\View\View;
use Carbon\Carbon;
use DB;

class NotificationTenenciaComposer {

    public function compose(View $view) {
        $year = Carbon::now()->year;

        $tenenciaCount = DB::table('unidades as u')
        ->leftJoin('tenencias as t', function($join) use ($year) {
            $join->on('t.id_unidad', '=', 'u.id_unidad')
                 ->whereYear('t.created_at', '=', $year);
        })
        ->whereNull('t.id_unidad')
        ->where(function($query) {
            $query->whereIn('u.id_estado', [1, 2, 3, 4, 8])
                  ->orWhereNull('u.id_estado');
        })
        ->count();

        $currentDate = ucfirst(Carbon::now()->locale('es')->isoFormat('MMMM DD'));

        $view->with([
            'tenenciaCount' => $tenenciaCount,
            'currentDate' => $currentDate,
        ]);
    }
}
