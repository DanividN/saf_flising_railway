<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\configuracion\cliente;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        cliente::create([
            'tipo_cliente' => 'PUBLICO',
            'nombre_cliente' => 'Supermercado La Economía',
            'rfc' => 'XAXX010101000',
            'calle' => 'Av. Principal',
            'n_interior' => '203',
            'n_exterior' => null,
            'id_municipio' => 12345,
            'codigo_postal' => 54321,
            'nombre_representante' => 'Pedro Gómez',
            'correo_representante' => 'pedro@laeconomia.com',
            'telefono_cliente' => '5551234567',
            'a_identificacion' => 'INE123456789',
            'a_situacion_fiscal' => 'Régimen General',
            'a_comprobante_domicilio' => 'Luz o Agua',
            'direccion_cliente' => 'Av. Principal #203, Col. Centro, Ciudad de México',
            'activo' => 1,
        ]);

        cliente::create([
            'tipo_cliente' => 'PRIVADO',
            'nombre_cliente' => 'Consultoría Legal Avanzada',
            'rfc' => 'YBZ123456XYZ',
            'calle' => 'Calle del Sol',
            'n_interior' => null,
            'n_exterior' => '102',
            'id_municipio' => 54321,
            'codigo_postal' => 12345,
            'nombre_representante' => 'Ana Martínez',
            'correo_representante' => 'ana@legalavanzada.com',
            'telefono_cliente' => '5559876543',
            'a_identificacion' => 'INE654321987',
            'a_situacion_fiscal' => 'Régimen Simplificado',
            'a_comprobante_domicilio' => 'Teléfono',
            'direccion_cliente' => 'Calle del Sol #102, Col. Reforma, Guadalajara',
            'activo' => 1,
        ]);
    }
}
