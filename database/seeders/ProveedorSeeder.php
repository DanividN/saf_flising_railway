<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\configuracion\agenciasTalleres;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Primer registro de ejemplo
        agenciasTalleres::create([
            'tipo' => 'AGENCIA',
            'servicios' => 'VENTA',
            'razon_social' => 'Razón Social A',
            'nombre_comercial' => 'Comercial A',
            'telefono_proveedor' => '1234567890',
            'rfc_proveedor' => 'ABCD123456XYZ',
            'correo_proveedor' => 'proveedor1@example.com',
            'calle_proveedor' => 'Calle 1',
            'n_exterior' => '123',
            'colonia' => 'Colonia A',
            'id_municipio' => 1,
            'cp_proveedor' => 12345,
            'direccion_proveedor' => 'Dirección 1',
            'activo' => 1,
            // Agrega más campos según sea necesario
        ]);

        // Segundo registro de ejemplo
        agenciasTalleres::create([
            'tipo' => 'TALLER',
            'servicios' => 'MANTENIMIENTO',
            'razon_social' => 'Razón Social B',
            'nombre_comercial' => 'Comercial B',
            'telefono_proveedor' => '9876543210',
            'rfc_proveedor' => 'WXYZ789012ABC',
            'correo_proveedor' => 'proveedor2@example.com',
            'calle_proveedor' => 'Calle 2',
            'n_exterior' => '456',
            'colonia' => 'Colonia B',
            'id_municipio' => 2,
            'cp_proveedor' => 54321,
            'direccion_proveedor' => 'Dirección 2',
            'activo' => 1,
            // Agrega más campos según sea necesario
        ]);

    }
}
