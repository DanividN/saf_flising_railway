<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="SAF">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="routeName" content="{{ Route::currentRouteName() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Icono de pestaña -->
    <link rel="shortcut icon" href="">
    <!-- Titulo de pestaña -->
    <title>SAF</title>

    <!-- Styles-->


        <!-- personalizado -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" />
    <link href="https://puertokhalid.com/up/demos/puerto-Mega_Menu/css/normalize.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css')}}">
    <link rel="stylesheet" href="{{ asset('css/menu_responsive.css')}}">
    <link rel="stylesheet" href="{{ asset('css/botones.css') }}">
    <link rel="stylesheet" href="{{ asset('css/spinner.css') }}">
    <link rel="stylesheet" href="{{ asset('css/agencias_talleres/agencias.css') }}">
    <link rel="stylesheet" href="{{ asset('css/maps/maps.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> <!-- OCUPO ESTE SCRIPT PARA LOS ESTILOS DE MI APP.CSS -->
    <link href="{{ asset('css/administracion/responsiveAdmin.css') }}" rel="stylesheet"> <!------------ RESPONSIVE DE ADMINISTRACION ------------>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/botones.css') }}">
    {{-- datatables --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    {{-- datatable --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/js/dataTables.js" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js" rel="stylesheet">
    {{--  --}}
        <!-- bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <!-- SweetAlert -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <!-- Datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
        <!-- Select2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!--scripts-->
        <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{--  Google Maps
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC46w9k4JVOj_KdMHgVYtUvnqnmz2R-sog&libraries=places&loading=async&callback=initMap" type="text/javascript"></script>
    <script defer src="{{ asset('configuracion/agencias_talleres/agencias_talleres.js') }}"></script>  --}}
    <script src="https://cdn.jsdelivr.net/autonumeric/2.0.0/autoNumeric.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4"></script>
    {{-----------huds---------}}
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" /> <!-- OCUPO ESTE SCRIPT PARA LOS ESTILOS DE  JQUERY -->
    {{-- <script src="http://code.jquery.com/jquery-1.9.1.js"></script> <!-- OCUPO ESTE SCRIPT PARA JQUERY --> --}}
    {{-- <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script> <!-- OCUPO ESTE SCRIPT PARA JQUERY --> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="jquery.ui.datepicker-es.js"></script>        <!-- OCUPO ESTE SCRIPT PARA EL CALENDARIO QUE AGARRE EL SCRIPT QUE OCUPA EL CALENDARIO -->
    <script src="{{asset('js/calendario.js')}}"></script>     <!-- OCUPO ESTE SCRIPT PARA EL CALENDARIO -->
    <script src="{{asset('js/separacionmiles.js')}}"></script>
    <script src="{{asset('js/datatable2.js')}}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
        <!-- OCUPO ESTE SCRIPT PARA EL CALENDARIO -->
    {{-- ---------------}}

</head>

<body class="sb-nav-fixed body-dash body-color">
    <nav class="sb-topnav navbar navbar-expand">
        <!-- Boton para el menu del siderbar-->
        <label class="menuu">
                    <button class="btn btn-sm" id="sidebarToggle" aria-label="Menu">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                        </svg>
                    </button>
                </label>
        <img class="img-logo" src="{{asset('img/layout/icon_header.png')}}" width="150px" alt="logo">
        <div class="row bread">
            <div class="col-md-12">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23fff'/%3E%3C/svg%3E&#34;" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    @section('breadcrumb')
                    @show
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Navbar name, texto o funcion en el centro del nav bar -->
        <span class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 text-white text-center ">
            <img src="{{asset('img/layout/logo_saf.png')}}" width="200px" alt="logoWhite" class="img-flising">

        </span>

        <!-- Nombre del usuario logueado -->
        <span class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 text-white ">

        </span>

            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-2 text-end logo_res">
                <li class="nav-item dropdown">
                    <img src="{{asset('img/layout/logo_saf_res.png')}}" width="140px" alt="logoWhite">
                </li>
            </ul>
        <!-- Iconos de notificaciones responsivo-->
            <ul class="navbar-nav ms-auto ms-md-2 me-3 me-lg-2 text-end campana">
                <li class="nav-item dropdown">
                    <a class="" href="{{route('notificaciones')}}" >
                        <img src="{{asset('img/notificaciones/notificaciones.png')}}" width="25px" alt="logoWhite">
                        <span class="position-absolute translate-middle rounded-pill bg-danger"></span>
                    </a>
                </li>
            </ul>
            <!-- notificaciones garantias -->
                {{-- <ul class="navbar-nav ms-auto ms-md-2 me-3 me-lg-2 text-end notification icons_header">
                    <li class="nav-item dropdown">
                        <div class="nav-link position-relative" aria-current="page" id="navbarDropdown1" data-bs-toggle="dropdown" aria-label="notificacion" class="respo">
                            <a  href="#" id="navbarDropdown1">
                                <img src="{{asset('img/notificaciones/noti_garantias.png')}}" width="25px" alt="logoWhite"  data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Garantía">
                                <span class="position-absolute translate-middle badge rounded-pill bg-warning not">
                                    <label>2</label>
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
                                    <img src="{{ asset('img/notificaciones/notificaciones_color/notificaciones_garantias.png') }}" width="30px" style="margin-left: 10px; margin-top:10px">
                                    <div class="ml-c">
                                        <p style="margin-top:-45px">Garant&iacute;as Flising:</p>
                                        <p style="margin-top:-15px;" class="text-notificacion">La cobertura de 99 unidades esta proxima a vencer</p>
                                    </div>
                                    <div style="margin-top:-10px;" class="date-noti ml-c">
                                        <span>Julio 25 a las 10:15 am</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul> --}}
                @include('components.alertas.notificacionGarantia')
            <!-- fin noti garantias -->
            <!-- notificaciones emergencias -->
                <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-2 text-end notification icons_header">
                    <li class="nav-item dropdown">
                        <div class="nav-link position-relative" aria-current="page" id="navbarDropdown1" data-bs-toggle="dropdown" aria-label="notificacion" class="respo">
                            <a  href="#" id="navbarDropdown1">
                                <img src="{{asset('img/notificaciones/noti_emergencias.png')}}" width="28px" alt="logoWhite" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Emergencias">
                                <span class="position-absolute translate-middle badge rounded-pill bg-warning not">
                                        <label>2</label>
                                    <span class="visually-hidden">Mensajes sin leer</span>
                                </span>
                            </a>
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown1" style="overflow: auto; max-height: 500px; min-height: 100px;width:240px !important" >
                            <li>
                                <!-- Cuerpo de la notificacion  -->
                                <input type="hidden" value="" name="id_base">
                                <label for="base" style="margin-left: 10px">Notificaciones</label><br>
                                <hr class="dropdown-divider" />
                                <div class="form-group">
                                    <img src="{{ asset('img/notificaciones/notificaciones_color/notificaciones_emergencias.png') }}" width="30px" style="margin-left: 10px; margin-top:10px">
                                    <div class="ml-c">
                                        <p style="margin-top:-35px">Emergencia:</p>
                                        <p style="margin-top:-15px;" class="text-notificacion">Nueva emergencia agregada. Secretaria General de Gobierno - ABC123D</p>
                                    </div>
                                    <div style="margin-top:-10px;" class="date-noti ml-c">
                                        <span>Julio 25 a las 10:15 am</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            <!-- fin notificaciones emergencias  -->

            <!-- notificaciones supervision -->
            @include('components.alertas.notificacionSupervision')
            @include('components.alertas.notificacionTenencia')
            <!-- fin notificaciones supervision-->

            <!-- notificaciones tenencias -->

            <!-- fin notificaciones tenencias  -->
            <!-- notificaciones verificacion -->
                @include('components.alertas.notificacionVerificacion')
            <!-- fin notificaciones verificacion -->
            <!-- notificaciones mantenimiento -->
                <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-2 text-end notification icons_header">
                    <li class="nav-item dropdown">
                        <div class="nav-link position-relative" aria-current="page" id="navbarDropdown1" data-bs-toggle="dropdown" aria-label="notificacion" class="respo">
                            <a  href="#" id="navbarDropdown1">
                                <img src="{{asset('img/notificaciones/notificaciones_mantenimiento.png')}}" width="35px" alt="logoWhite" class="noti-mtto" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Mantenimiento" >
                                <span class="position-absolute translate-middle badge rounded-pill bg-warning not">
                                    <label>2</label>
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
                                    <img src="{{ asset('img/notificaciones/notificaciones_color/notificaciones_mantenimiento.png') }}" width="35px" style="margin-left: 10px; margin-top:10px">
                                    <div class="ml-c">
                                        <p style="margin-top:-35px">Mantenimiento:</p>
                                        <p style="margin-top:-15px;" class="text-notificacion">Tienes 99 mantenimientos pendientes</p>
                                    </div>
                                    <div style="margin-top:-10px;" class="date-noti ml-c">
                                        <span>Julio 25 a las 10:15 am</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            <!-- fin notificaciones mantenimiento -->
            <!-- notificaciones seguro -->
                <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-2 text-end notification icons_header">
                    <li class="nav-item dropdown">
                    <div class="nav-link position-relative" aria-current="page" id="navbarDropdown1" data-bs-toggle="dropdown" aria-label="notificacion" class="respo">
                        <a  href="#" id="navbarDropdown1">
                            <img src="{{asset('img/notificaciones/notificaciones_seguro.png')}}" width="28px" alt="logoWhite" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Seguro">
                            <span class="position-absolute translate-middle badge rounded-pill bg-warning not">
                                <label>2</label>
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
                                    <img src="{{ asset('img/notificaciones/notificaciones_color/notificaciones_seguro.png') }}" width="30px" style="margin-left: 10px; margin-top:10px">
                                    <div class="ml-c">
                                        <p style="margin-top:-40px">Seguros:</p>
                                        <p style="margin-top:-15px;" class="text-notificacion">Hay 99 Seguros pendientes de pago.</p>
                                    </div>
                                    <div style="margin-top:-10px;" class="date-noti ml-c">
                                        <span>Julio 25 a las 10:15 am</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            <!-- fin notificaciones seguro -->
        <!-- Fin notificaciones -->
        <!-- Navbar, boton desplegable con menu-->
        <ul class="navbar-nav ms-auto ms-md-2 me-3 me-lg-4 text-end user icons_header">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Logout">
                    <img src="{{asset('img/layout/logo_usuario.png')}}" width="28px" alt="logoWhite">
                </a>
                <ul class="dropdown-menu dropdown-menu-end mnu" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item text-dark" href="#!">
                            <i class="bi bi-person"></i> <strong>Admin</strong>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <a class="dropdown-item " href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf

                                <button type="submit" class="text-dark border-0 bg-transparent p-0"><i class="bi bi-box-arrow-left"></i> Cerrar Sesión</button>
                            </form>
                        </a>
                        <form id="logout-form" action="" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- Sidebar -->
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="nav" role="navigation">
                <div class="d-flex flex-column flex-shrink-0 bg-color" style="width: 4.5rem;margin-top: 80px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16" id="sidebarToggle1" aria-label="Menu">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                        </svg>
                    <ul class="nav nav-pills nav-flush flex-column mb-auto text-center mcd-menu">
                        <!-- Botones del sidebar -->
                            <!-- Home o Dashb9oard -->
                            <li class="img-hd">
                                <img src="{{ asset('img/layout/logo_saf-menu.png') }}" width="160px">
                            </li>
                            <li>
                                <hr class="hr" />
                            </li>
                            <li class="@yield('inicio') nav-item activ">
                                <label class="icon-wb">
                                    <span class="nav-link py-2 img-menu" aria-label="Home" data-bs-toggle="tooltip" data-bs-placement="right" aria-expanded="false">
                                        <img src="{{ asset('img/menu/inicio.png') }}" width="35px" height="35px" class="home">
                                    </span>
                                </label>
                                <label class="link-rp">
                                    <a href="">
                                        <p class="text-menu">Mesa de control</p>
                                        <span class="nav-link py-2 img-menu" aria-label="Home" data-bs-toggle="tooltip" data-bs-placement="right" aria-expanded="false">
                                            <img src="{{ asset('img/menu/inicio.png') }}" width="35px" height="35px" class="home">
                                        </span>
                                    </a>
                                </label>
                                <ul class="sub-menu ml-1 inicio">
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('img/home/mesa_control.png') }}" width="30px">
                                            <span>Inicio</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <!-- Configuración -->
                            <li class="@yield('configuracion') nav-item activ">
                                <input id="confi" type="checkbox" hidden/>
                                <label for="confi">
                                    <i class="bi bi-chevron-right"></i><p class="text-menu">Configuraci&oacute;n</p>
                                    <span class="nav-link py-2 img-menu" aria-label="Configuración" data-bs-toggle="tooltip" data-bs-placement="right">
                                        <img src="{{ asset('img/menu/configuracion.png') }}" width="35px" height="35px">
                                    </span>
                                </label>
                                <ul class="sub-menu ml-1 configuracion">
                                    <li>
                                        <a href="{{ route('clientes.index') }}" class="sb-mn">
                                            <img src="{{asset('img/configuracion/registro_clientes.png')}}" width="30px">
                                            <span>Registro de Clientes</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('unidades.index') }}" class="sb-mn">
                                            <img src="{{asset('img/configuracion/registro_unidades.png')}}" width="30px" >
                                            <span>Registro de Unidades</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('aseguradoras.index') }}" class="sb-mn aseguradora">
                                            <img src="{{asset('img/configuracion/registro_aseguradoras.png')}}" width="30px" >
                                            <span>Registro de Aseguradoras</span>
                                        </a>
                                    </li>
                                    <li class="text-alg">
                                        <a href="{{ route('agencias_talleres/index') }}" class="sb-mn">
                                            <img src="{{asset('img/configuracion/agencias_talleres.png')}}" width="30px">
                                                <span>Registro de Agencias o Talleres</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('gps.index') }}" class="sb-mn">
                                            <img src="{{asset('img/configuracion/registro_gps.png')}}" width="30px" >
                                            <span>GPS</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('garantias.index') }}" class="sb-mn">
                                            <img src="{{asset('img/configuracion/registro_garantias.png')}}" width="30px" >
                                            <span>Garant&iacute;as Flising</span>
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="{{ route('usuarios.index') }}" class="sb-mn">
                                            <img src="{{asset('img/configuracion/registro_usuarios.png')}}" width="30px" >
                                            <span>Registro de Usuarios</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <!-- Administracion -->
                            <li class="@yield('admi') nav-item activ">
                                <input id="admin" type="checkbox" hidden />
                                <label for="admin">
                                    <i class="bi bi-chevron-right"></i><p class="text-menu">Administraci&oacute;n</p>
                                    <span class="nav-link py-2 img-menu" aria-label="administracion" data-bs-toggle="tooltip" data-bs-placement="right">
                                        <img src="{{ asset('/img/menu/administracion.png') }}" width="35px" height="35px">
                                    </span>
                                </label>
                                <ul class="sub-menu administracion ml-1">
                                    <li>
                                        <a href="{{ route('asignacionUnidades.index') }}" class="@yield('asignacion_unidades')">
                                            <img src="{{asset('img/administracion/asignacion_unidades.png')}}" width="30px" >
                                            <span>Asignaci&oacute;n de unidades</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('mantenimientos/autorizacion/index')}}" class="@yield('autorizacion_mtto')">
                                            <img src="{{asset('img/administracion/autorizaciones_mantenimiento.png')}}" width="30px">
                                            <span>Autorizaciones de mantenimiento</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('emergencias.index')}}" class="@yield('emergencia')">
                                            <img src="{{asset('img/administracion/emergencias.png')}}" width="30px" >
                                            <span>Emergencias</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('garantias_flising.index') }}" class="@yield('garantias_flising')">
                                            <img src="{{asset('img/administracion/garantias_flising.png')}}" width="30px" >
                                            <span>Garant&iacute;a Flising</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.garantiasAgencia.index') }}" class="sb-mn">
                                            <img src="{{asset('img/configuracion/registro_garantias.png')}}" width="30px" >
                                            <span>Garant&iacute;as Agencia</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('supervision.index')}}" class="@yield('supervisicion')">
                                            <img src="{{asset('img/administracion/supervision.png')}}" width="30px" >
                                            <span>Supervisi&oacute;n</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('unidadTenencia.index')}}" class="@yield('tenencias')">
                                            <img src="{{asset('img/administracion/tenencia.png')}}" width="30px" >
                                            <span>Tenencia</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('asignacionPoliza.index')}}" class="@yield('seguro')">
                                            <img src="{{asset('img/administracion/seguro.png')}}" width="30px" >
                                            <span>Seguro - GPS</span>
                                        </a>
                                    </li>
                                    <li >
                                        <a href="{{ route('verificacion.indexAdministracion') }}" class="@yield('verificacion')">
                                            <img src="{{asset('img/funciones/funciones_verificacion.png')}}" width="30px" >
                                            <span>Verificaci&oacute;n</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('mantenimientos/index')}}" class="@yield('mantenimiento')">
                                            <img src="{{asset('img/funciones/funciones_mantenimiento.png')}}" width="30px" >
                                            <span>Mantenimiento</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <!-- Funciones-->
                            <li class="@yield('funciones') nav-item activ">
                                <input id="funciones" type="checkbox" hidden />
                                <label for="funciones">
                                <i class="bi bi-chevron-right"></i><p class="text-menu">Funciones</i></p>
                                    <span class="nav-link py-2 img-menu" aria-label="Funciones" data-bs-toggle="tooltip" data-bs-placement="right">
                                        <img src="{{ asset('img/menu/funciones.png') }}" width="35px" height="35px">
                                    </span>
                                </label>
                                <ul class="sub-menu funcion ml-1">
                                    <li >
                                        <a href="{{ route('verificacion.indexFunciones') }}" class="@yield('verificacion')">
                                            <img src="{{asset('img/funciones/funciones_verificacion.png')}}" width="30px" >
                                            <span>Verificaci&oacute;n</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('mantenimientos.index')}}" class="@yield('mantenimiento')">
                                            <img src="{{asset('img/funciones/funciones_mantenimiento.png')}}" width="30px" >
                                            <span>Mantenimiento</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('asignacionSiniestro.index')}}" class="@yield('siniestros')">
                                            <img src="{{asset('img/funciones/funciones_siniestros.png')}}" width="30px" >
                                            <span>Siniestros</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('emergenciasCall.index')}}" class="@yield('Emergencias')">
                                            <img src="{{asset('img/funciones/funciones_emergencias.png')}}" width="30px" >
                                            <span>Emergencias</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('garantias_callCenter.index')}}" class="@yield('garantias_f')">
                                            <img src="{{asset('img/funciones/funciones_garantias.png')}}" width="30px" >
                                            <span>Garantías Flising</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('funciones.garantiasAgencia.index') }}" class="sb-mn">
                                            <img src="{{asset('img/configuracion/registro_garantias.png')}}" width="30px" >
                                            <span>Garant&iacute;as Agencia</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        <!-- Estadísticas -->
                            <li  class="@yield('estadisticas') nav-item activ info">
                                <input id="estadisticas" type="checkbox" hidden />
                                <label for="estadisticas">
                                    <i class="bi bi-chevron-right"></i><p class="text-menu">Estad&iacute;sticas</p>
                                    <span class="nav-link py-2 img-menu" aria-label="Estadisticas" data-bs-toggle="tooltip" data-bs-placement="right">
                                        <img src="{{ asset('img/menu/estadisticas.png') }}" width="35px" height="35px">
                                    </span>
                                </label>
                                <ul class="sub-menu informe ml-1 info">
                                    <li>
                                        <a href="{{URL('informes/informeTenencias')}}" class="@yield('informe_tenencia')">
                                            <img src="{{asset('img/informes/estadisticas_informe.png')}}" width="25px" >
                                            <span>Informe Tenencias</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{URL('informes/informeSegurosGps')}}" class="@yield('informe_seguro')">
                                            <img src="{{asset('img/informes/estadisticas_informe.png')}}" width="25px" >
                                            <span>Informe Seguros-GPS</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('verificacion.showInforme')}}" class="@yield('informe_verificaciones')">
                                            <img src="{{asset('img/informes/estadisticas_informe.png')}}" width="25px" >
                                            <span>Informe Verificaciones</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{URL('informes/informeMantenimiento')}}" class="@yield('informe_mtto')">
                                            <img src="{{asset('img/informes/estadisticas_informe.png')}}" width="25px" >
                                            <span>Informe Mantenimiento</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{URL('informes/informeSiniestros')}}" class="@yield('informe_siniestro')">
                                            <img src="{{asset('img/informes/estadisticas_informe.png')}}" width="25px" >
                                            <span>Informe Siniestros</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('supervision.informe.supervision') }}" class="@yield('informe_supervision')">
                                            <img src="{{asset('img/informes/estadisticas_informe.png')}}" width="25px" >
                                            <span>Informe Supervisi&oacute;n</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{URL('informes/informeAdministrativo')}}" class="@yield('informe_administrativo')">
                                            <img src="{{asset('img/informes/estadisticas_informe.png')}}" width="25px" >
                                            <span>Informe Administrativo</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{URL('informes/informeCallCenter')}}" class="@yield('informe_callcenter')">
                                            <img src="{{asset('img/informes/estadisticas_informe.png')}}" width="25px" >
                                            <span>Informe Call Center</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{URL('informes/informeEgresos')}}" class="@yield('informe_egresos')">
                                            <img src="{{asset('img/informes/estadisticas_informe.png')}}" width="25px" >
                                            <span>Informe de Egresos</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{URL('informes/informeProductividad')}}" class="@yield('informe_productividad')">
                                            <img src="{{asset('img/informes/estadisticas_informe.png')}}" width="25px" >
                                            <span>Informe de Productividad</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{URL('informes/informeCallCenter')}}" class="@yield('informe_agenda')">
                                            <img src="{{asset('img/informes/estadisticas_informe.png')}}" width="25px" >
                                            <span>Informe de Agenda</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        <!-- visor -->
                            <li class="@yield('visor') nav-item activ">
                                <label class="icon-wb">
                                    <span class="nav-link py-2 img-menu" aria-label="Visor" data-bs-toggle="tooltip" data-bs-placement="right">
                                        <img src="{{ asset('img/menu/visor.png') }}" width="35px" height="35px">
                                    </span>
                                </label>
                                <label class="link-rp">
                                    <a href="">
                                        <p class="text-menu">Visor</p>
                                        <span class="nav-link py-2 img-menu" aria-label="Visor" data-bs-toggle="tooltip" data-bs-placement="right">
                                            <img src="{{ asset('img/menu/visor.png') }}" width="35px" height="35px">
                                        </span>
                                    </a>
                                </label>
                                <ul class="sub-menu ml-1 visor">
                                    <li>
                                        <a href="{{ url('visor/geolocalizacion') }}">
                                            <img src="{{asset('img/visor/visor.png')}}" width="30px" >
                                            <span>Visor</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        <!-- Tutoriales -->
                            <li class="@yield('tutorial') nav-item activ" >
                                <label class="icon-wb">
                                    <span class="nav-link py-2 img-menu" aria-label="Tutoriales"  data-bs-toggle="tooltip" data-bs-placement="right">
                                        <img src="{{ asset('img/menu/tutoriales.png') }}" width="35px" height="35px">
                                    </span>
                                </label>
                                <label class="link-rp">
                                    <a href="">
                                        <p class="text-menu">Tutoriales</p>
                                        <span class="nav-link py-2 img-menu" aria-label="Tutoriales"  data-bs-toggle="tooltip" data-bs-placement="right">
                                            <img src="{{ asset('img/menu/tutoriales.png') }}" width="35px" height="35px">
                                        </span>
                                    </a>
                                </label>
                                <ul class="sub-menu ml-1 tutoriales">
                                    <li>
                                        <a href="#">
                                        <img src="{{ asset('img/tutoriales/tutoriales.png') }}" width="25px" height="25px">
                                            <span>Tutoriales</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- Contenido de las paginas -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid mt-3">
                    @section('content')
                    @show
                </div>
            </main>
        </div>
        @include('configuracion.usuarios.modalResetearPassword')
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous" ></script>
        <!-- siderbar -->
    <script src="{{ asset('js/scripts.js') }}" defer ></script>
    <script src="{{ asset('js/sidebars.js') }}"  ></script>
        <!-- Datatables -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
        <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <!-- Validaciones -->
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')
            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
      <script >
        $(document).ready(function() {
            $('#summernote').summernote({
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    // ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                ],
            });
            $('.summernot').summernote({
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    // ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                ],
            });
            $('#summernote2').summernote({
                toolbar: [],
            }).summernote('disable');
            $('#summernote3').summernote({
                toolbar: [],
            }).summernote('disable');
        });
    </script>
    </script>

    @if(session('needs_to_reset_password'))
        <script src="{{ asset('js/validacion_password.js') }}"></script>
    @endif
    <!-- Scripts personalizados -->
    @section('scripts')
    @show
</body>
</html>
