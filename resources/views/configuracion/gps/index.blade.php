@extends('layouts.app')

@section('configuracion', 'active')
@section('breadcrumb')
        <!-- Apartado para poner las rutas o breadcrumb -->
        <li class="breadcrumb-item" aria-current="page"><span class="rutas"><small>Configuración</small></span></li>
        <li class="breadcrumb-item active" aria-current="page"><span class="rutas"><small>GPS</small></span></li>
@endsection

@section('content')
@include('components.alertas')
<div class="container-fluid mt-5">
    <div class="titulo-responsive">
        <label><a>Registro de GPS</a></label>
    </div>
    <div class="card">
        <div class="">
            <div class="d-flex justify-content-end mt-3 me-3 mb-0" style="margin-left: .4cm;">
                <a class="btn boton-principal text-white" href="{{route('gps.create')}}"
                  id="btn-pantcomp">
                  <i class="fas fa-plus me-2"></i>Agregar GPS</a>

                <a class="btn boton-principal text-white" href="{{route('gps.create')}}"
                  id="btn-responsive">
                  <i class="fas fa-plus me-2"></i></a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th class="encabezado">No.</th>
                            <th class="encabezado">Nombre</th>
                            <th class="encabezado">Razón Social</th>
                            <th class="encabezado">RFC</th>
                            <th class="encabezado">Fecha de registro</th>
                            <th class="encabezado">Teléfono</th>
                            <th class="encabezado">Municipio</th>
                            <th class="encabezado">Acción</th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center;">
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($gps as $gp)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$gp->nombre_gps}}</td>
                            <td>{{$gp->razon_gps}}</td>
                            <td>{{$gp->rfc_gps}}</td>
                            <td>{{$gp->created_at->format('m/d/Y')}}</td>
                            <td>{{$gp->telefono_gps}}</td>
                            <td>{{$gp->municipio->nombre_municipio}}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="dropdown-toggle dropdown-toggle-no-caret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}" alt="menu" style="width: 30px !important;">
                                    </a>
                                    <ul class="dropdown-menu p-0">
                                        <li><a class="dropdown-item" href="{{ route('gps.show',$gp->id_gps) }}">Ver/Editar</a></li>
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
