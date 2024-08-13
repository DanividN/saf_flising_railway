<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\configuracion\garantiasProveedores;

class GarantiaProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear dos registros de ejemplo
        garantiasProveedores::create([
            'id_proveedor' => 1,
            'nombre_g_proveedor' => 'Proveedor A',
            'vigencia_g_proveedor' => '2025-01-01',
            'monto_g_proveedor' => 5000.00,
            'a_g_evidencia' => 'ruta/al/archivo1.pdf',
            'activo' => 1,
        ]);

        garantiasProveedores::create([
            'id_proveedor' => 2,
            'nombre_g_proveedor' => 'Proveedor B',
            'vigencia_g_proveedor' => '2024-12-31',
            'monto_g_proveedor' => 7500.50,
            'a_g_evidencia' => 'ruta/al/archivo2.pdf',
            'activo' => 1,
        ]);
    }
}
