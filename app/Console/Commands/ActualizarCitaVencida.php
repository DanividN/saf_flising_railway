<?php

namespace App\Console\Commands;

use App\Models\administracion\CitaSupervision;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ActualizarCitaVencida extends Command {
    protected $signature = 'app:actualizar-cita-vencida';
    protected $description = 'Actualizar las citas agendadas a vencidas';

    public function handle() {
        Log::info('Actualizar las citas agendadas a vencidas');
        Log::info('Hora de ejecucuión: ' . now());

        try {
            DB::table('citas_supervision')
                ->where('notificacion_citas', 'AGENDADA')
                ->whereRaw('CONCAT(fecha_supervision, " ", hora) < NOW()')
                ->update(['notificacion_citas' => 'VENCIDA']);

            Log::info('Citas actualizadas a vencidas');
        } catch (\Throwable $th) {
            Log::error('Error al actualizar las citas a vencidas');
            Log::error($th->getMessage());
        }
    }
}
