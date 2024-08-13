<ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-2 text-end notification icons_header">
    <li class="nav-item dropdown">
        <div class="nav-link position-relative" aria-current="page" id="navbarDropdown1" data-bs-toggle="dropdown" aria-label="notificacion" class="respo">
            <a href="#" id="navbarDropdown1">
                <img src="{{asset('img/notificaciones/notificaciones_tenencia.png')}}" width="28px" alt="logoWhite" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Tenencia">
                <span class="position-absolute translate-middle badge rounded-pill bg-warning not">
                    <label>{{ $tenenciaCount }}</label>
                    <span class="visually-hidden">Mensajes sin leer</span>
                </span>
            </a>
        </div>
        <ul class="dropdown-menu dropdown-menu-end " aria-labelledby="navbarDropdown1" style="overflow: auto; max-height: 500px; min-height: 100px;width:240px !important" >
            <li>
                <!-- Cuerpo de la notificacion  -->
                <input type="hidden" value="" name="id_base">
                <label for="base" style="margin-left: 10px">Notificaciones</label><br>
                <hr class="dropdown-divider" />
                <div class="form-group">
                    <img src="{{ asset('img/notificaciones/notificaciones_color/notificaciones_tenencia.png') }}" width="30px" style="margin-left: 10px; margin-top:10px">
                    <div class="ml-c">
                        <p style="margin-top:-35px">Tenencia:</p>
                        <p style="margin-top:-15px;" class="text-notificacion">{{ $tenenciaCount }} Tenencias pendientes de pago.</p>
                    </div>
                    <div style="margin-top:-10px;" class="date-noti ml-c">
                        <span>{{ $currentDate }}</span>
                    </div>
                </div>
            </li>
        </ul>
    </li>
</ul>
