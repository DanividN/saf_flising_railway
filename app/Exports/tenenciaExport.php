<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Models\configuracion\unidad;
use Maatwebsite\Excel\Concerns\WithEvents;

class tenenciaExport implements FromView, ShouldAutoSize, WithEvents
{
    protected $unidad;

    function __construct($unidad)
    {
        $this->unidad = $unidad;
    }

    public function view(): View
    {
        $unidades = unidad::with('tenencia')->find($this->unidad);
        $tenencias = $unidades ? $unidades->tenencia : collect();
        $tenencias = $tenencias->map(function ($item) {
            $item->monto = (float) str_replace(',', '', $item->monto);
            return $item;
        });


        return view('administracion.tenencias.export', [
            'unidades' => $unidades,
            'tenencias' => $tenencias
        ]);
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $highestRow = $event->sheet->getHighestRow();
                $event->sheet->getStyle('E6:E' . $highestRow)
                    ->getNumberFormat()
                    ->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD);

                $sheet = $event->sheet->getDelegate();
                for ($row = 6; $row <= $highestRow; $row++) {
                    $cellValue = $sheet->getCell('E' . $row)->getValue();
                    if (is_string($cellValue) && is_numeric(str_replace(',', '', $cellValue))) {
                        $sheet->setCellValue('E' . $row, (float) str_replace(',', '', $cellValue));
                    }
                }
            },
        ];
    }

}
