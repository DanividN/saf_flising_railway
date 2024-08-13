<ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-2 text-end notification icons_header">
    <li class="nav-item dropdown">
        <div
            class="nav-link  position-relative" 
            aria-current="page" 
            id="navbarDropdown1" 
            data-bs-toggle="dropdown" 
            aria-label="notificacion" 
            class="respo"
        >
            <img src="{{asset('img/notificaciones/noti_supervision.png')}}" width="28px" alt="logoWhite" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Supervisión">
            <span class="position-absolute translate-middle badge rounded-pill bg-warning not">
                <label>{{ $supervisionesCount }}</label>
                <span class="visually-hidden">Mensajes sin leer</span>
            </span>
        </div>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown1" style="overflow: auto; max-height: 500px; min-height: 100px;width:240px !important" >
            <label for="base" style="margin-left: 10px">Notificaciones</label><br>
            @forelse ($supervisiones as $supervision)
                <a 
                    style="text-decoration: none; color: black;"
                    @if ($supervision->notificacion_citas == 'CONCLUIDA')
                        href="{{ route('supervision.validacion.unidad', $supervision->id_citas_supervision) }}"
                    @endif
                >
                    <li>
                        <input type="hidden" value="" name="id_base">
                        <hr class="dropdown-divider" />
                        <div class="form-group">
                            <img src="{{ asset('img/pwa/clientes.png') }}" width="30px" style="margin-left: 10px; margin-top:10px">
                            <div class="ml-c">
                                <p style="margin-top:-35px">
                                    @if ($supervision->notificacion_citas == 'CONCLUIDA')
                                        Nueva supervisión concluida
                                    @endif
                                </p>
                                <p style="margin-top:-15px;" class="text-notificacion"> {{ $supervision->cliente->nombre_cliente }}-{{ $supervision->asignacionUnidad->placas }}</p>
                            </div>
                            <div style="margin-top:-10px;" class="date-noti ml-c">
                                <span>
                                    {{ ucfirst(\Carbon\Carbon::parse($supervision->updated_at)->locale('es')->isoFormat('MMMM DD')) }}
                                    a las {{ \Carbon\Carbon::parse($supervision->updated_at)->format('h:i A') }}
                                </span>
                            </div>
                        </div>
                    </li>
                </a>
            @empty
                <div class="d-flex justify-content-center align-items-center mt-3">No hay notificaciónes</div>
            @endforelse
        </ul>
    </li>
</ul>