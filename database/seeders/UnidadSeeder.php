<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\configuracion\unidad;


class UnidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        unidad::create([
            'id_tipo_unidad' => 1,
            'id_marca' => 1,
            'id_estado' => 1,
            'id_proveedor' => 1,
            'modelo' => 'Sedan',
            'year' => 2023,
            'color' => 'Negro',
            'n_serie' => 'SN1234',
            'n_motor' => 'MOTOR5678',
            'kilometraje' => '10000 km',
            'vehiculo_id' => 'PF 0008',
            'fecha_mantenimiento' => '2023-06-15',
            'costo_mantenimiento' => 250.00,
            'activo' => 1,
        ]);

        unidad::create([
            'id_tipo_unidad' => 2,
            'id_marca' => 2,
            'id_estado' => 2,
            'id_proveedor' => 2,
            'modelo' => 'Pickup',
            'year' => 2022,
            'color' => 'Blanco',
            'n_serie' => 'SN5678',
            'n_motor' => 'MOTOR9101',
            'kilometraje' => '5000 km',
            'vehiculo_id' => 'PF 0010',
            'fecha_mantenimiento' => '2023-03-20',
            'costo_mantenimiento' => 180.00,
            'activo' => 1,
            // Agrega más campos según sea necesario
        ]);
    }
}
