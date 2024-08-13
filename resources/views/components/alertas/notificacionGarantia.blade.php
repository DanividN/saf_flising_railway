<ul class="navbar-nav ms-auto ms-md-2 me-3 me-lg-2 text-end notification icons_header">
    <li class="nav-item dropdown">
        <a class="nav-link position-relative" aria-current="page" href="#" id="navbarDropdown1"
            data-bs-toggle="dropdown" aria-label="notificacion" class="respo">
            <img src="{{ asset('img/notificaciones/noti_garantias.png') }}" width="25px" alt="logoWhite">
            <span class="position-absolute translate-middle badge rounded-pill bg-warning not">
                <label>{{ $contadorGarantias }}</label>
                <span class="visually-hidden">Mensajes sin leer</span>
            </span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end " aria-labelledby="navbarDropdown1"
            style="overflow: auto; max-height: 500px; min-height: 100px;width:240px !important">
            <li>
                <!-- Cuerpo de la notificacion  -->
                <input type="hidden" value="" name="id_base">
                <label for="base" style="margin-left: 10px">Notificaciones</label><br>
                <hr class="dropdown-divider" />
                @if ($contadorGarantias > 0)
                    <div class="form-group">
                        <img src="{{ asset('img/notificaciones/notificaciones_color/notificaciones_garantias.png') }}"
                            width="30px" style="margin-left: 10px; margin-top:10px">
                        <div class="ml-c">
                            <p style="margin-top:-45px">Garant&iacute;as Flising:</p>
                            <p style="margin-top:-15px;" class="text-notificacion"> La cobertura de
                                {{ $contadorGarantias }} @choice('Unidad | Unidades ', $contadorGarantias) está próxima a vencer.</p>
                        </div>
                        <div style="margin-top:-10px;" class="date-noti ml-c">
                            <span>{{ ucfirst(Carbon\Carbon::now('America/Mexico_City')->locale('es')->isoFormat('MMMM D [a las] H:mm A')) }}</span>
                        </div>
                    </div>
                @else
                <div class="d-flex justify-content-center align-items-center mt-3">No hay notificaciónes</div>
                @endif
            </li>
        </ul>
    </li>
</ul>
