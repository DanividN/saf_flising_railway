<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use App\Models\configuracion\unidad;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class siniestroExport implements FromView, ShouldAutoSize, WithEvents
{
    protected $unidad;

    function __construct($unidad)
    {
        $this->unidad = $unidad;
    }

    public function view(): View
    {
        $unidades = unidad::with('siniestros')->find($this->unidad);
        $siniestros = $unidades ? $unidades->siniestros:collect();

        return view('funciones.siniestros.export', [
            'unidades' => $unidades,
            'siniestros' => $siniestros
        ]);
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $highestRow = $event->sheet->getHighestRow();
                $event->sheet->getStyle('H6:H' . $highestRow)
                    ->getNumberFormat()
                    ->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD);

                $sheet = $event->sheet->getDelegate();
                for ($row = 6; $row <= $highestRow; $row++) {
                    $cellValue = $sheet->getCell('H' . $row)->getValue();
                    if (is_string($cellValue) && is_numeric(str_replace(',', '', $cellValue))) {
                        $sheet->setCellValue('H' . $row, (float) str_replace(',', '', $cellValue));
                    }
                }
            },
        ];
    }
}
