<ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-2 text-end notification icons_header">
    <li class="nav-item dropdown">
        <a class="nav-link  position-relative" aria-current="page" href="#" id="navbarDropdown1" data-bs-toggle="dropdown" aria-label="notificacion">
            <img src="{{asset('img/notificaciones/notificaciones_verificacion.png')}}" width="28px" alt="logoWhite">
            <span class="position-absolute translate-middle badge rounded-pill bg-warning not">
                <label>{{$verificacionesCount}}</label>
                <span class="visually-hidden">Mensajes sin leer</span>
            </span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end " aria-labelledby="navbarDropdown1" style="overflow: auto; max-height: 500px; min-height: 100px;width:240px !important">
            <li>
                <!-- Cuerpo de la notificacion  -->
                <input type="hidden" value="" name="id_base">
                <label for="base" style="margin-left: 10px">Notificaciones</label><br>
                @forelse($verificacionesAlertas as $key => $value)
                <hr class="dropdown-divider" />
                <a href="{{route('verificacion.indexFunciones')}}" style="text-decoration: none;color: black;">
                    <div class="form-group">
                        <img src="{{ asset('img/notificaciones/notificaciones_color/notificaciones_verificacion.png') }}" width="30px" style="margin-left: 10px; margin-top:10px">
                        <div class="ml-c">
                            <p style="margin-top:-35px">Verificaci&oacute;n:</p>
                            <p style="margin-top:-15px;" class="text-notificacion">Tienes {{$value->unidades}} verificaciones de unidad {{$value->estado[0]}} del {{$value->estado[1]?'primer':'segundo'}} semestre con terminanci&oacute;n {{$key}}</p>
                        </div>
                    </div>
                </a>
                @empty
                <div class="d-flex justify-content-center align-items-center mt-3">No hay notificaciónes</div>
                @endforelse

                <hr class="dropdown-divider" />
                <div class="date-noti text-center">
                    @php Carbon\Carbon::setLocale('es'); @endphp
                    <span>{{Carbon\Carbon::now('America/Mexico_City')->isoFormat('MMMM D, H:mm A')}}</span>
                </div>
            </li>
        </ul>
    </li>
</ul>
