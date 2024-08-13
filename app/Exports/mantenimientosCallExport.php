<?php

namespace App\Exports;

use App\Models\administracion\asignacionPoliza;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\funciones\MantenimientoCallCenter;

class mantenimientosCallExport implements FromView{

    protected $unidad_id;

    function __construct($unidad_id){
        $this->id_unidad = $unidad_id;
    }

    public function view(): View{
        //
        $mantenimientos = MantenimientoCallCenter::with(
            'asignacion_unidad',
            'unidad','unidad.marca',
            'asignacion_unidad.cliente',
            'asignacion_unidad.responsable',
            'seguimiento_mantenimiento',
            'proveedor',
            )
        ->where('id_unidad', $this->id_unidad)->get();
        //dd($mantenimientos);
        return view('funciones.mantenimientos.excel.informe', [
            'mantenimientos' => $mantenimientos,
        ]);
    }
}
