@forelse ($citas as $key => $cita)
    <a 
        @if ($cita->notificacion_citas == \App\Models\administracion\CitaSupervision::AGENDADA || $cita->notificacion_citas == \App\Models\administracion\CitaSupervision::VENCIDA)
            href="{{ route('pwa.clientes.unidades.agregar-validacion', $cita->id_citas_supervision) }}"
        @endif 

        @if ($cita->notificacion_citas == \App\Models\administracion\CitaSupervision::CANCELADA || $cita->notificacion_citas == \App\Models\administracion\CitaSupervision::CONCLUIDA)
            href="{{ route('pwa.clientes.unidades.mostrar.validacion', $cita->id_citas_supervision) }}"
        @endif
        class="text-decoration-none text-dark"
    >
        <div class="card-body row p-3">
            <div class="col-2 p-0">
                @if ($cita->notificacion_citas == \App\Models\administracion\CitaSupervision::AGENDADA)
                    <img src="{{ asset('img/pwa/agendada.png') }}" alt="icono cita agendada" style="width: 100%; height: 100%;">
                @endif

                @if ($cita->notificacion_citas == \App\Models\administracion\CitaSupervision::CANCELADA)
                    <img src="{{ asset('img/pwa/cancelada.png') }}" alt="icono cita cancelada" style="width: 100%; height: 100%;">
                @endif

                @if ($cita->notificacion_citas == \App\Models\administracion\CitaSupervision::CONCLUIDA)
                    <img src="{{ asset('img/pwa/concluida.png') }}" alt="icono cita concluida" style="width: 100%; height: 100%;">
                @endif

                @if ($cita->notificacion_citas == \App\Models\administracion\CitaSupervision::VENCIDA)
                    <img src="{{ asset('img/pwa/vencida.png') }}" alt="icono cita vencida" style="width: 100%; height: 100%;">
                @endif
            </div>
            
            <div class="text-start col-8">
                <h6 class="m-0 text-orange font-bold">{{ $cita->unidad->marca->descripcion }}/{{ $cita->unidad->modelo }}</h6>
                <h6 class="m-0">{{ $cita->unidad->vehiculo_id }}</h6>
                <h6 class="m-0">{{ $cita->cliente->nombre_cliente }}</h6>
            </div>
            
            <div class="col-2 d-flex justify-content-center align-items-center">
                <img src="{{ asset('img/pwa/right-arrow.png') }}" alt="icono flecha">
            </div>
        </div>
    </a>
    <hr>    
@empty
    <div class="d-flex justify-content-center align-items-center mt-2 font-bold">
        <p>No se encontraron coincidencias.</p>
    </div>
@endforelse