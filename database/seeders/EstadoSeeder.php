<?php

namespace Database\Seeders;

use App\Models\catalogos\estado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estados = [
            [
                'id_estado' => 1,
                'nombre_estado' => 'Arrendamiento nuevo',
                'tipo' => 2,
                'accion' => 'OCUPADA',
            ],
            [
                'id_estado' => 2,
                'nombre_estado' => 'Arrendamiento reasignacion',
                'tipo' => 2,
                'accion' => 'OCUPADA',
            ],
            [
                'id_estado' => 3,
                'nombre_estado' => 'Falta de pago',
                'tipo' => 2,
                'accion' => 'DISPONIBLE',
            ],
            [
                'id_estado' => 4,
                'nombre_estado' => 'Fin de plazo',
                'tipo' => 2,
                'accion' => 'DISPONIBLE',
            ],
            [
                'id_estado' => 5,
                'nombre_estado' => 'Venta directa',
                'tipo' => 1,
                'accion' => 'BAJA',
            ],
            [
                'id_estado' => 6,
                'nombre_estado' => 'Venta residual',
                'tipo' => 1,
                'accion' => 'BAJA',
            ],
            [
                'id_estado' => 7,
                'nombre_estado' => 'Baja por siniestro',
                'tipo' => 2,
                'accion' => 'BAJA',
            ],
            [
                'id_estado' => 8,
                'nombre_estado' => 'Desasignar',
                'tipo' => 2,
                'accion' => 'DISPONIBLE',
            ],
        ];

        // Iterar sobre el arreglo $estados y crear registros en la base de datos
        foreach ($estados as $estado) {
            estado::create($estado);
        }
    }
}
