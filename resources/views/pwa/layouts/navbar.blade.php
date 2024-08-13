<nav class="navbar navbar-expand-lg bg-body-tertiary p-2 sticky-top">
  <div class="container-fluid">
      <a class="navbar-brand" href="{{ route('pwa.clientes') }}">
          <img src="{{ asset('img/pwa/home.png') }}" alt="icon home">
      </a>

      <a class="navbar-brand" href="#">
          <img src="{{ asset('img/layout/logo_saf-menu.png') }}" style="width: 120px;" alt="logo saf">
      </a>

      <div class="d-flex gap-2">
        <div class="dropdown">
          <a class="nav-link dropdown-toggle no-arrow" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Logout">
              <img src="{{ asset('img/pwa/user.png') }}" alt="icon logout" height="32">
          </a>

          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <li>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit" class="text-dark border-0 bg-transparent p-0"><i class="bi bi-box-arrow-left"></i> Cerrar Sesión</button>
                  </form> 
                </a>
              </li>
          </ul>
        </div>

        <div class="notification-icon">
          <a href="{{ route('pwa.clientes.notificaciones') }}">
            <img src="{{ asset('img/pwa/bell.png') }}" alt="icono notificaciones">
          </a>
          <span class="notification-number">{{ $notificationCount }}</span>
        </div>
      </div>
  </div>

  @if (Request::route()->getName() == 'pwa.clientes.notificaciones')
    <div class="col-12 border-0 p-2 d-flex align-items-center">
        <div class="col-1 text-center">
            <a href="{{ url()->previous() }}">
                <img src="{{ asset('img/pwa/flecha.png') }}" alt="iconno regresar" width="24" height="24">
            </a>
        </div>
        <div class="col-11 text-center">
            <h5 class="m-0 font-bold">Notificaciones</h5>
        </div>
    </div>
  @endif

  @yield('headers-navbar')
</nav>