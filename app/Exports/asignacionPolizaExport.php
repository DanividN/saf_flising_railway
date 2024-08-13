<?php

namespace App\Exports;

use App\Models\administracion\asignacionPoliza;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class asignacionPolizaExport implements FromView
{
    protected $id_unidad;

    function __construct($id_unidad)
    {
        $this->id_unidad = $id_unidad;
    }

    public function view(): View
    {
        $polizaAsiganada = asignacionPoliza::with([
            'unidad.datosAsignacion',
            'unidad.marca',
            'unidad.tipo_unidad',
            'unidad.datosAsignacion.responsable',
            'unidad.datosAsignacion.cliente',
            'unidad.datosAseguradora.gps',
            'unidad.datosAseguradora.polizas',
            'aseguradora'
        ])->where('id_unidad',$this->id_unidad)->get();

        return view('administracion.seguroGPS.excel.informe', [
            'polizaAsiganada' => $polizaAsiganada,
        ]);
    }
}
