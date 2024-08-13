@extends('layouts.app')

@section('scripts')
    <script src="{{ asset('js/modulo.users.js') }}"></script>
@endsection

@section('configuracion','active')

@section('breadcrumb')
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Configuración</small></a></span></li>
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Registro de Usuarios</small></a></span></li>
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Editar Usuario</small></a></span></li>
@endsection

@section('content')
    @include('components.alertas')

    <div class="titulo-responsive">
        <label><a>Editar Usuario</a></label>
    </div>


    <div class="card shadow-md mt-5 border-0 p-2">
        <div class="card-body">
            <form action="{{ route('usuarios.update', $usuario->id) }}" id="create-user-form" method="POST" class="needs-validation" novalidate>
                @method('PATCH')
                @csrf
                
                @include('configuracion.usuarios._form', ['usuario' => $usuario])

                <div class="d-flex justify-content-center gap-4 mt-4">
                    @include('components.btn-regresar', ['link' => 'usuarios.index'])
                    @include('components.btn-guardar', ['id' => 'btn-guardar-usuario'])
                </div>
            </form>

            <input type="hidden" id="permisos_cargados" value="{{ json_encode($permisos) }}">
            <input type="hidden" id="roles_cargados" value="{{ json_encode($roles) }}">
        </div>
    </div>
    @include('configuracion.usuarios.agregarClientes', ['usuarioClientes' => $usuarioClientes])
@endsection