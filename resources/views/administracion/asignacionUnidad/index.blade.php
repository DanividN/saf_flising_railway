@extends('layouts.app')
@section('content')
@section('scripts')
@include('components.alertas')
<script src="{{asset('js/datatable.js')}}"></script>
@endsection
@section('admi', 'active')
@section('breadcrumb')       
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Administración</small></a></span></li>            
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="{{ route('asignacionUnidades.index') }}" class="rutas"><small>Asignación de unidades</small></a></span></li>            
@endsection


<div class="container-fluid mt-5">
    <div class="card shadow-md border-gray-100 border-0 p-2">
            <div class="row">
                <div class="d-flex justify-content-end" style="margin-left: -.4cm;">
                    <a href="{{ route('step1') }}" class="btn add_agencia"
                        id="btn-pantcomp">
                        <i class="fa fa-plus"></i>
                        Asignar unidades
                    </a>

                    <a href="{{ route('step1') }}" class="btn add_agencia" 
                        id="btn-responsive">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="table" class="table table-sm text-center">
                    <thead>
                        <tr>
                            <th class='text-center'>No</th>
                            <th class='text-center'>Cliente</th>
                            <th class='text-center'>Arrendamientos</th>
                            <th class='text-center'>Tipo de Cliente</th>
                            <th class='text-center'>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientes as $cliente)
                        <tr>
                            <td>{{$cliente->id_cliente}}</td>
                            <td>{{$cliente->nombre_cliente}}</td>
                            <td>{{count($cliente->activos)}}</td>
                            <td>{{$cliente->tipo_cliente}}</td>

                            <td class="text-center align-middle">
                                <div class="dropdown">
                                    <a class="dropdown-toggle dropdown-toggle-no-caret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}" alt="menu" style="width: 30px !important;">
                                    </a>
                                    <ul class="dropdown-menu p-0">

                                        <li><a class="dropdown-item" href='{{Route('asignacionUnidades.show',$cliente->id_cliente)}}'>Lista de unidades</a></li>
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
