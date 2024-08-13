<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\catalogos\plazoArrendamiento;

class PazoArrendamientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        plazoArrendamiento::create([
            'id_plazo' => 1,
            'plazo' => 12,
        ]);
        plazoArrendamiento::create([
            'id_plazo' => 2,
            'plazo' => 24,
        ]);
        plazoArrendamiento::create([
            'id_plazo' => 3,
            'plazo' => 36,
        ]);
        plazoArrendamiento::create([
            'id_plazo' => 4,
            'plazo' => 48,
        ]);
        plazoArrendamiento::create([
            'id_plazo' => 5,
            'plazo' => 60,
        ]);
    }
}
