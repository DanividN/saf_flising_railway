<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\configuracion\responsable;

class ResponsableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Primer registro de ejemplo
        responsable::create([
            'id_cliente' => 11,
            'nombre_responsable' => 'Juan Pérez',
            'telefono_responsable' => '1234567890',
            'correo_responsable' => 'juan.perez@example.com',
            'folio_ine' => 'ABC123456XYZ',
            'numero_empleado' => 101,
            'a_ine_responsable' => 'Activo',
            'activo' => 1,
            // Agrega más campos según sea necesario
        ]);

        // Segundo registro de ejemplo
        responsable::create([
            'id_cliente' => 10,
            'nombre_responsable' => 'María García',
            'telefono_responsable' => '9876543210',
            'correo_responsable' => 'maria.garcia@example.com',
            'folio_ine' => 'XYZ789012ABC',
            'numero_empleado' => 202,
            'a_ine_responsable' => 'Activo',
            'activo' => 1,
            // Agrega más campos según sea necesario
        ]);
    }
}
