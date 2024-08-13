@extends('layouts.app')

@section('configuracion','active')

@section('breadcrumb')
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Configuración</small></a></span></li>
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Registro de Usuarios</small></a></span></li>
@endsection

@section('content')
    @include('components.alertas')
    <div class="container-fluid mt-5">

        <div class="titulo-responsive">
            <label><a>Registro de Usuarios</a></label>
        </div>

        <div class="card shadow-md border-gray-100 border-0 p-2">
            <div class="d-flex justify-content-end me-3 mt-5">
                <a href="{{ route('usuarios.create') }}" class="btn boton-principal text-white"
                    id="btn-pantcomp">
                    <i class="fas fa-plus me-2"></i>Agregar usuario
                </a>

                <a href="{{ route('usuarios.create') }}" class="btn boton-principal text-white"
                    id="btn-responsive">
                    <i class="fas fa-plus me-2"></i>
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" class="encabezado">No.</th>
                                <th scope="col" class="encabezado">Nombre</th>
                                <th scope="col" class="encabezado">Correo</th>
                                <th scope="col" class="encabezado">Tipo de usuario</th>
                                <th scope="col" class="encabezado">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $index => $usuario)
                                <tr class="text-center">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $usuario->name }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td>
                                        @if ($usuario->tipo_usuario == \App\Models\User::ADMINISTRATIVO)
                                            Administrativo
                                        @elseif ($usuario->tipo_usuario == \App\Models\User::CALLCENTER)
                                            Call Center
                                        @elseif ($usuario->tipo_usuario == \App\Models\User::SUPERVISIONAPP)
                                            Supervisión App
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle dropdown-toggle-no-caret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}" alt="menu" style="width: 30px !important;">
                                            </a>
                                            
                                            <ul class="dropdown-menu p-0">
                                                <li>
                                                    <form action="{{ route('usuarios.restablecer.password', $usuario->id) }}" method="POST">
                                                        @method('PATCH')
                                                        @csrf
                                                        <button type="submit" class="dropdown-item">Restablecer contraseña</button>
                                                    </form>
                                                </li>
                                                <li><a class="dropdown-item" href="{{ route('usuarios.edit', $usuario->id) }}">Ver/Editar</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection