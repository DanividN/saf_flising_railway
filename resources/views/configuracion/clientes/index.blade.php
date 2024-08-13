@extends('layouts.app')
@section('configuracion','active')
@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Configuración</small></a></span></li>
<li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Registro de clientes</small></a></span></li>
@endsection
@section('content')
@include('components.alertas')
    <div class="container-fluid mt-5">
        <div class="titulo-responsive">
            <label><a>Registro de Clientes:</a></label>
        </div>
        <div class="card shadow-md border-gray-100 border-0 p-2">
            <div class="card-body">

                {{-- boton agregar ----}}
                {{-- <div class="row"> --}}
                    <div class="d-flex justify-content-end mb-2" style="margin-top:-10px;">
                        <a href="{{ route('clientes.create') }}" class="btn add_agencia" id="btn-pantcomp">
                            <i class="bi bi-plus-lg"></i> Agregar cliente
                        </a>

                        <a href="{{ route('clientes.create') }}" class="btn add_agencia" id="btn-responsive">
                            <i class="bi bi-plus-lg"></i>
                        </a>
                    </div>
                {{-- </div> --}}
                {{-- -----------------}}
                <div class="table-responsive mt-2">
                    <table class="table" id="table">
                        <thead>
                            <th scope="col" class="text-start encabezado">No</th>
                            <th scope="col" class="encabezado">Cliente/Área/Dependencia</th>
                            <th scope="col" class="encabezado">Tipo de Cliente</th>
                            <th scope="col" class="encabezado">Fecha de registro</th>
                            <th scope="col" class="encabezado">Telefono</th>
                            <th scope="col" class="encabezado">Acción</th>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $cliente)
                                <tr class="text-center">
                                    <td class="text-start">{{ $loop->iteration }}</td>
                                    <td>{{ $cliente->nombre_cliente }}</td>
                                    <td>{{ $cliente->tipo_cliente }}</td>
                                    <td>{{ $cliente->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $cliente->telefono_cliente }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="dropdown-toggle dropdown-toggle-no-caret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}" alt="menu" style="width: 30px !important;">
                                            </a>

                                            <ul class="dropdown-menu p-0">
                                                <li><a class="dropdown-item" href="{{ route('clientes.ver', $cliente) }}">Ver/Editar</a></li>
                                                <li><a class="dropdown-item" href="{{ route('clientes.show', $cliente) }}">Seguimiento</a></li>
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
