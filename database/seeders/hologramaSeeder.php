<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\catalogos\holograma;

class hologramaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        holograma::create([
            'descripcion'=>'0,0',
            'tiempo'=>'2 años',
        ]);
        holograma::create([
            'descripcion'=>'0',
            'tiempo'=>'6 Meses',
        ]);
        holograma::create([
            'descripcion'=>'1',
            'tiempo'=>'6 Meses',
        ]);
        holograma::create([
            'descripcion'=>'2',
            'tiempo'=>'6 Meses',
        ]);
        holograma::create([
            'descripcion'=>'E',
            'tiempo'=>'8 años',
        ]);
    }
}
