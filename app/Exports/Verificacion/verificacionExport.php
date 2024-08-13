<?php

namespace App\Exports\Verificacion;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;

// use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class verificacionExport implements FromView, WithEvents, ShouldAutoSize
{
    protected $unidad;
    public function __construct($unidad)
    {
        $this->unidad = $unidad;
    }

    public function view(): View
    {
        return view('funciones.verificaciones.excel', ['unidad' => $this->unidad]);
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                for ($row = 6; $row <= $event->sheet->getHighestRow(); $row++) {
                    $event->sheet->getStyle('F' . $row)->getNumberFormat()
                        ->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD);
                }
            },
        ];
    }

    // public function columnFormats(): array
    // {
    //     return [
    //         'F' => NumberFormat::FORMAT_CURRENCY_USD,
    //     ];
    // }
}
