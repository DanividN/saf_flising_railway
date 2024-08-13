@extends('pwa.layouts.pwa')

@section('content')
    @include('components.alertas')
    <div class="container-fluid mt-2">
        <div class="card shadow-md border-gray-100 border-0 p-2 mt-2">
            @foreach ($citas as $cita)
                <a 
                    @if ($cita->notificacion_citas == \App\Models\administracion\CitaSupervision::AGENDADA || $cita->notificacion_citas == \App\Models\administracion\CitaSupervision::VENCIDA)
                        href="{{ route('pwa.clientes.unidades.agregar-validacion', $cita->id_citas_supervision) }}"
                    @endif 
            
                    @if ($cita->notificacion_citas == \App\Models\administracion\CitaSupervision::CANCELADA || $cita->notificacion_citas == \App\Models\administracion\CitaSupervision::VALIDADA || $cita->notificacion_citas == \App\Models\administracion\CitaSupervision::CONCLUIDA)
                        href="{{ route('pwa.clientes.unidades.mostrar.validacion', $cita->id_citas_supervision) }}"
                    @endif
                    class="text-decoration-none text-dark"
                >
                    <div class="card-header bg-white border-0 p-0 d-flex justify-content-start align-items-center">
                        <span 
                            @if ($cita->notificacion_citas == 'AGENDADA')
                                class="badge bg-blue-status status"
                            @elseif ($cita->notificacion_citas == 'CANCELADA')
                                class="badge bg-red-status status"
                            @elseif ($cita->notificacion_citas == 'VENCIDA')
                                class="badge bg-yellow-status status"
                            @elseif ($cita->notificacion_citas == 'CONCLUIDA')
                                class="badge bg-green-status status"
                            @elseif ($cita->notificacion_citas == 'VALIDADA')
                                class="badge bg-yellow-900-status status"
                            @endif 
                            style="border-radius: 40%; display: inline-block; height: 15px; width: 15px;"
                        ></span>
                        <span class="font-bold" style="margin-left: 5px;">
                            @if ($cita->notificacion_citas == 'AGENDADA')
                                Nueva supervisión asignada
                            @elseif ($cita->notificacion_citas == 'CANCELADA')
                                Nueva supervisión cancelada
                            @elseif ($cita->notificacion_citas == 'VENCIDA')
                                Nueva supervisión vencida
                            @elseif ($cita->notificacion_citas == 'CONCLUIDA')
                                Nueva supervisión concluida
                            @elseif ($cita->notificacion_citas == 'VALIDADA')
                                Nueva supervisión validada
                            @endif
                        </span>
                    </div>
                    <div class="card-body row p-3" style="margin-top: -10px;">
                        <p class="p-0 m-0 text-gray font-semibold">
                            @if ($cita->notificacion_citas == 'AGENDADA')
                                Se ha generado una nueva supervisión.
                            @elseif ($cita->notificacion_citas == 'CANCELADA')
                                Se ha cancelado una supervisión.
                            @elseif ($cita->notificacion_citas == 'VENCIDA')
                                Se ha vencido una supervisión.
                            @elseif ($cita->notificacion_citas == 'CONCLUIDA')
                                Se ha concluido una supervisión.
                            @elseif ($cita->notificacion_citas == 'VALIDADA')
                                Se ha validado una supervisión.
                            @endif
                        </p>
                        <p class="p-0 m-0 text-gray font-semibold">
                            Unidad {{ $cita->unidad->marca->descripcion }} {{ $cita->unidad->modelo }} / {{ $cita->asignacionUnidad->placas }} - {{ $cita->cliente->nombre_cliente }}
                        </p>
                        <p class="p-0 m-0 text-gray font-semibold">
                            {{ \Carbon\Carbon::create($cita->updated_at, 1, 0, 0, 0, 'America/Mexico_City')->locale('es')->isoFormat('DD [de] MMMM [del] YYYY') }}
                        </p>
                    </div>
                </a>
                <hr class="mt-0">    
            @endforeach
        </div>
    </div>
@endsection