<?php

namespace App\Exports;

use App\Models\administracion\CitaSupervision;
use App\Models\configuracion\cliente;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InformeSupervisionPorUnidad implements FromView {

    protected $id_unidad, $id_cliente;

    function __construct($id_unidad, $id_cliente) {
        $this->id_unidad = $id_unidad;
        $this->id_cliente = $id_cliente;
    }

    public function view(): View {
        $citas = CitaSupervision::with('cliente', 'supervisor', 'unidad.tipo_unidad', 'asignacionUnidad', 'unidad.marca', 'supervision')
            ->where('id_cliente', $this->id_cliente)
            ->where('id_unidad', $this->id_unidad)
            ->orderBy('created_at', 'desc')
            ->get();
                
        $cliente = cliente::find($this->id_cliente);

        return view('administracion.supervision.excel.informe')->with(compact('citas', 'cliente'));
    }
}