<?php

namespace App\Exports;

use App\Models\administracion\CitaSupervision;
use App\Models\configuracion\cliente;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InformeSupervisionExport implements FromView {

    protected $id_cliente, $status, $year, $mes;

    function __construct($id_cliente, $status, $year, $mes) {
        $this->id_cliente = $id_cliente;
        $this->status = $status;
        $this->year = $year;
        $this->mes = $mes;
    }

    public function view(): View {
        $citas = CitaSupervision::with('cliente', 'supervisor', 'unidad.tipo_unidad', 'asignacionUnidad', 'unidad.marca', 'supervision')
            ->where('id_cliente', $this->id_cliente)
            ->where('notificacion_citas', $this->status)
            ->whereYear('fecha_supervision', $this->year)
            ->whereMonth('fecha_supervision', $this->mes)
            ->orderBy('created_at', 'desc')
            ->get();

        $cliente = cliente::find($this->id_cliente);
        $mes = \Carbon\Carbon::createFromDate($this->year, $this->mes, 1)->locale('es')->translatedFormat('F');

        return view('administracion.supervision.excel.informe')->with(compact('citas', 'cliente', 'mes'));
    }
}