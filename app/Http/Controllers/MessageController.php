<?php
// app/Http/Controllers/MessageController.php
namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Emergency;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class MessageController extends Controller
{
    public function store(Request $request, $id_asignacion_emergencia)
    {
        $user_id = Auth::user()->id;
        $nombre = Auth::user()->name;
        $tipo_usuario = Auth::user()->tipo_usuario;

        $emergencia = DB::table('asignacion_emergencia')
        ->join('tipo_emergencia', 'tipo_emergencia.id_tipo_emergencia', '=', 'asignacion_emergencia.id_tipo_emergencia')
        ->select('tipo_emergencia.descripcion as emergencia')
        ->where('asignacion_emergencia.id_asignacion_emergencia', $id_asignacion_emergencia)
        ->first();


        Message::create([
            'id_asignacion_emergencia' => $id_asignacion_emergencia,
            'user_id' => $user_id,
            'message' => $request->message,
        ]);

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'
        ),
            [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => true,
            ]
        );

        $pusher->trigger('Flising_chat', 'evento'.$id_asignacion_emergencia,[
            'id_asignacion_emergencia' => $id_asignacion_emergencia,
            'user_id' => $user_id,
            'message' => $request->message,
            'nombre' => $nombre,
            'tipo_usuario' => $tipo_usuario,
            'date' => date('Y-m-d H:i:s'),
            'emergencia' =>  $emergencia->emergencia
        ]);

        return response()->json();
    }

}


