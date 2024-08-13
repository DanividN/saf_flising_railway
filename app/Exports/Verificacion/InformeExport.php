<?php

namespace App\Exports\Verificacion;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;

class InformeExport implements FromView, WithEvents, ShouldAutoSize
{
    protected $unidades;
    public function __construct($unidades)
    {
        $this->unidades = $unidades;
    }

    public function view(): View
    {
        return view('funciones.verificaciones.informe', ['unidades' => $this->unidades]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                for ($row = 4; $row <= $event->sheet->getHighestRow(); $row++) {
                    $event->sheet->getStyle('H' . $row)->getNumberFormat()
                        ->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD);
                }
            },
        ];
    }
}
