<?php

namespace Database\Seeders;

use App\Models\catalogos\year;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class yearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        year::create([
            'descripcion' => '2018'
        ]);
        year::create([
            'descripcion' => '2019'
        ]);
        year::create([
            'descripcion' => '2020'
        ]);
        year::create([
            'descripcion' => '2021'
        ]);
        year::create([
            'descripcion' => '2022'
        ]);
        year::create([
            'descripcion' => '2023'
        ]);
        year::create([
            'descripcion' => '2024'
        ]);
        year::create([
            'descripcion' => '2025'
        ]);
        year::create([
            'descripcion' => '2026'
        ]);
        year::create([
            'descripcion' => '2027'
        ]);
        year::create([
            'descripcion' => '2028'
        ]);
        year::create([
            'descripcion' => '2029'
        ]);
        year::create([
            'descripcion' => '2030'
        ]);
    }
}
