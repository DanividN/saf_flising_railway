<?php

namespace Database\Seeders;

use App\Models\catalogos\mantenimientoTiempo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class mantenimientoTiempoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        mantenimientoTiempo::create([
            'descripcion' => '1 Mes'
        ]);
        mantenimientoTiempo::create([
            'descripcion' => '2 Meses'
        ]);
        mantenimientoTiempo::create([
            'descripcion' => '3 Meses'
        ]);
        mantenimientoTiempo::create([
            'descripcion' => '4 Meses'
        ]);
        mantenimientoTiempo::create([
            'descripcion' => '5 Meses'
        ]);
        mantenimientoTiempo::create([
            'descripcion' => '6 meses'
        ]);
        mantenimientoTiempo::create([
            'descripcion' => '7 Meses'
        ]);
        mantenimientoTiempo::create([
            'descripcion' => '8 Meses'
        ]);
        mantenimientoTiempo::create([
            'descripcion' => '9 Meses'
        ]);
        mantenimientoTiempo::create([
            'descripcion' => '10 Meses'
        ]);
        mantenimientoTiempo::create([
            'descripcion' => '11 Meses'
        ]);
        mantenimientoTiempo::create([
            'descripcion' => '12 Meses'
        ]);
    }
}
