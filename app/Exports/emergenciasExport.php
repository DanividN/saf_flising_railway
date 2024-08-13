<?php

namespace App\Exports;

use App\Models\funciones\emergenciasCall;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class emergenciasExport implements FromView
{
    protected $emergencia;

    function __construct($emergencia)
    {
        $this->emergencia = $emergencia;
    }

    public function view(): View
    {
        $emergencias =  emergenciasCall::getEmergencia($this->emergencia);

        return view('funciones.emergencias.excel.informe', [
            'emergencias' => $emergencias,
        ]);
    }
}
