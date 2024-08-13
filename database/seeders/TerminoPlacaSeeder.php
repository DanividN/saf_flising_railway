<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\catalogos\terminoPlaca;

class TerminoPlacaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        terminoPlaca::create([
            'descripcion' => '5 y 6',
            'color' => 'Amarillo',
            'primer_semestre' => 'febrero - marzo',
            'segundo_semestre' => 'julio y agosto',
        ]);

        terminoPlaca::create([
            'descripcion' => '7 y 8',
            'color' => 'Rosa',
            'primer_semestre' => 'febrero - marzo',
            'segundo_semestre' => 'agosto y septiembre',
        ]);

        terminoPlaca::create([
            'descripcion' => '3 y 4',
            'color' => 'Rojo',
            'primer_semestre' => 'marzo - abril',
            'segundo_semestre' => 'septiembre y octubre',
        ]);

        terminoPlaca::create([
            'descripcion' => '1 y 2',
            'color' => 'Verde',
            'primer_semestre' => 'abril - mayo',
            'segundo_semestre' => 'octubre y noviembre',
        ]);

        terminoPlaca::create([
            'descripcion' => '9 y 0',
            'color' => 'Azul',
            'primer_semestre' => 'mayo - junio',
            'segundo_semestre' => 'noviembre y diciembre',
        ]);

    }
}
