@extends('layouts.app')

@section('scripts')
    <script src="{{ asset('js/modulo.users.js') }}"></script>
@endsection

@section('configuracion','active')

@section('breadcrumb')
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Configuración</small></a></span></li>
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Registro de Usuarios</small></a></span></li>
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Agregar Usuario</small></a></span></li>
@endsection

@section('content')
    @include('components.alertas')

    <div class="titulo-responsive mn-0">
        <label><a>Agregar Usuario</a></label>
    </div>

    <div class="card shadow-md border-0 p-2 mt-5">
        <div class="card-body">
            <form action="{{ route('usuarios.store') }}" id="create-user-form" method="POST" class="needs-validation" novalidate>
                @csrf

                @include('configuracion.usuarios._form', ['usuario' => $usuario])

                <div class="d-flex justify-content-center gap-4 mt-4">
                    @include('components.btn-regresar', ['link' => 'usuarios.index'])
                    @include('components.btn-guardar', ['id' => 'btn-guardar-usuario'])
                </div>
            </form>
        </div>
    </div>
    @include('configuracion.usuarios.agregarClientes', ['usuarioClientes' => []])
@endsection