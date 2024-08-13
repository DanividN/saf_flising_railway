<?php

namespace Database\Seeders;

use App\Models\catalogos\marca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class marcasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        marca::create([
            'descripcion'=>'Abarth'
        ]);
        marca::create([
            'descripcion'=>'Acura'
        ]);
        marca::create([
            'descripcion'=>'Alfa Romeo'
        ]);
        marca::create([
            'descripcion'=>'ARRA'
        ]);
        marca::create([
            'descripcion'=>'Aston Martin'
        ]);
        marca::create([
            'descripcion'=>'Audi'
        ]);
        marca::create([
            'descripcion'=>'BAIC'
        ]);
        marca::create([
            'descripcion'=>'Bentley'
        ]);
        marca::create([
            'descripcion'=>'Bestune'
        ]);
        marca::create([
            'descripcion'=>'BMW'
        ]);
        marca::create([
            'descripcion'=>'Buick'
        ]);
        marca::create([
            'descripcion'=>'BYD'
        ]);
        marca::create([
            'descripcion'=>'Cadillac'
        ]);
        marca::create([
            'descripcion'=>'Changan'
        ]);
        marca::create([
            'descripcion'=>'Chirey'
        ]);
        marca::create([
            'descripcion'=>'Chevrolet'
        ]);
        marca::create([
            'descripcion'=>'Chrysler'
        ]);
        marca::create([
            'descripcion'=>'Cupra'
        ]);
        marca::create([
            'descripcion'=>'Dodge'
        ]);
        marca::create([
            'descripcion'=>'DFSK'
        ]);
        marca::create([
            'descripcion'=>'FAW'
        ]);
        marca::create([
            'descripcion'=>'Ferrari'
        ]);
        marca::create([
            'descripcion'=>'Fiat'
        ]);
        marca::create([
            'descripcion'=>'Ford'
        ]);
    }
}
