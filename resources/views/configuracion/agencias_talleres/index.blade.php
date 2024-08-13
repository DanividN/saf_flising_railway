@extends('layouts.app')
@section('styles')  
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2-bootstrap-5-theme.min.css') }}">
@endsection
@section('scripts')
    <script defer src="{{ asset('assets/plugins/select2-4.1/js/select2.min.js') }}"></script>
    <script defer src="{{ asset('js/select2.js') }}"></script>
    <script src="{{asset('js/datatable.js')}}"></script> 
@endsection
@section('content')
    @include('components.alertas')
    <div>      
        <div class="col-md-12 mt-5">
            <div class="titulo-responsive">
                <label><a>Registro de Agencias o Talleres</a></label>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8 mt-2">
                            <!-- Listado de Agencias y Talleres -->
                        </div>
                        <div class="d-flex justify-content-end mt-4 mb-0" style="margin-left: -.4cm;">
                            <a href="{{ route('agencias_talleres/nuevo') }}" class="btn add_agencia"
                            id="btn-pantcomp">
                                <i class="bi bi-plus-lg"></i> Agregar agencia / taller
                            </a>

                            <a href="{{ route('agencias_talleres/nuevo') }}" class="btn add_agencia"
                            id="btn-responsive">
                                <i class="bi bi-plus-lg"></i>
                            </a>
                        </div>
                    </div>


                <div class="card-body">
                    <div class="table-responsive">
                        <table class="tabla" id="table">
                            <thead>
                                <tr>
                                    <th class="text-center encabezado">No.</th>
                                    <th class="text-center encabezado">Nombre</th>
                                    <th class="text-center encabezado">Raz&oacute;n Social</th>
                                    <th class="text-center encabezado">RFC</th>
                                    <th class="text-center encabezado"fecha_p">Fecha de registro</th>
                                    <th class="text-center encabezado">Tel&eacute;fono</th>
                                    <th class="text-center encabezado">Municipio</th>
                                    <th class="text-center encabezado">Acci&oacute;n</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($proveedores as $proveedor)
                                    <tr>
                                        <td class="text-center align-middle">{{ ++$i }}</td>
                                        <td class="text-center align-middle">
                                            <span title="{{ $proveedor->nombre_comercial }}" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                                {{ Str::limit($proveedor->nombre_comercial,20) }} 
                                            </span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <span title="{{ $proveedor->razon_social }}" data-bs-toggle="tooltip" data-bs-placement="bottom">
                                                {{ Str::limit($proveedor->razon_social,20) }} 
                                            </span>
                                        </td>
                                        <td class="text-center align-middle">{{ $proveedor->rfc_proveedor }}</td>
                                        <td class="text-center align-middle">{{ $proveedor->fecha_registro }}</td>
                                        <td class="text-center align-middle">{{ $proveedor->telefono_proveedor }}</td>
                                        <td class="text-center align-middle">{{ $proveedor->nombre_municipio }}</td>
                                        <td class="text-center align-middle">
                                            <div class="dropdown">
                                                <a class="dropdown-toggle dropdown-toggle-no-caret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}" alt="menu" style="width: 30px !important;">
                                                </a>
                                                <ul class="dropdown-menu p-0">
                                                    <li><a class="dropdown-item" href="{{ url('configuracion/agencias_talleres/ver/'.$proveedor->id_proveedor) }}">Ver / Editar</a></li>
                                                    <li><a class="dropdown-item" href="{{ url('configuracion/agencias_talleres/seguimiento/'.$proveedor->id_proveedor) }}">Seguimiento</a></li>
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
    </div>
@endsection