<?php

namespace Database\Seeders;

use App\Models\catalogos\tipoUnidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tipoUnidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        tipoUnidad::create([
            'descripcion'=>'Automovil'
        ]);
        tipoUnidad::create([
            'descripcion'=>'Camioneta'
        ]);
        tipoUnidad::create([
            'descripcion'=>'Motocicleta'
        ]);
    }
}
