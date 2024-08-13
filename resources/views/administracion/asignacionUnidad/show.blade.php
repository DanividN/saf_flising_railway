@extends('layouts.app')
@section('content')
@include('components.alertas')

@section('admi', 'active')
@section('breadcrumb')       
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Administración</small></a></span></li>            
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="{{ route('asignacionUnidades.index') }}" class="rutas"><small>Asignación de unidades</small></a></span></li>            
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="{{ route('asignacionUnidades.show',$cliente->id_cliente)}}" class="rutas"><small>Lista de unidades</small></a></span></li>            
@endsection

<div class="container-fluid mb-4 mt-5">
    <div class="card border-0">
        <div class="card-body">
            <div class="row d-flex">
                <div class="col-md-4">
                    <div class="col">
                        <b>Tipo de cliente: </b><span class="text-gray">{{$cliente->tipo_cliente}}</span>
                    </div>

                    <div class="col mt-2">
                        <b>Nombre: </b><span class="text-gray">{{$cliente->nombre_cliente}}</span>
                    </div>

                    <div class="col mt-2">
                        <b>Titular del Área: </b><span class="text-gray">{{$cliente->nombre_representante}}</span>
                    </div>

                    <div class="col mt-2">
                        <b>Correo: </b><span class="text-gray">{{$cliente->correo_representante}}</span>
                    </div>

                    <div class="col mt-2">
                        <b>Telefono: </b><span class="text-gray">{{$cliente->telefono_cliente}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card shadow-md border-gray-100 border-0 p-2">
            <div class="row">
                <div class="d-flex justify-content-end" style="margin-left: -.4cm;">
                    <a href="{{ route('step1',['cliente'=>$cliente->id_cliente]) }}" class="btn add_agencia" id="btn-pantcomp">
                        <i class="fa fa-plus"></i>
                        Asignar unidades
                    </a>

                    <a href="{{ route('step1',['cliente'=>$cliente->id_cliente]) }}" class="btn add_agencia" id="btn-responsive">
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
                            <th class='text-center'>Marca</th>
                            <th class='text-center'>Plazo</th>
                            <th class='text-center'>Fecha inicial</th>
                            <th class='text-center'>Fecha final</th>
                            <th class='text-center'>Placas</th>
                            <th class='text-center'>Etapa completada</th>
                            <th class='text-center'>Estatus</th>
                            <th class='text-center'>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count=0; ?>
                        @foreach($arrendamientos as $arrendamiento)
                        <tr>
                            <td>{{++$count}}</td>
                            <td>{{$arrendamiento->unidad->marca->descripcion}}</td>
                            <td>{{$arrendamiento->Plazo->plazo}}</td>
                            <td>{{date_format($arrendamiento->fecha_inicial, 'Y-m-d')}}</td>
                            <td>{{date_format($arrendamiento->fecha_final, 'Y-m-d')}}</td>
                            <td>{{$arrendamiento->placas??'No asignadas'}}</td>
                            <td>{{$arrendamiento->etapa}}</td>
                            <td>{{$arrendamiento->DetalleAsignacion->estado->nombre_estado}}</td>

                            <td class="text-center align-middle">
                                <div class="dropdown">
                                    <a class="dropdown-toggle dropdown-toggle-no-caret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}" alt="menu" style="width: 30px !important;">
                                    </a>
                                    <ul class="dropdown-menu p-0">

                                        <li><a class="dropdown-item" href='{{Route('step'.($arrendamiento->etapa==4?2:($arrendamiento->etapa + 1) ), $arrendamiento->id_asignacion_unidad)}}'>{{$arrendamiento->etapa==4?'Ver':'Editar'}}</a></li>
                                        @if(count($arrendamiento->DetallesAsignacion)==1)
                                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-asignar-garantias" onclick='modal({{$arrendamiento->id_asignacion_unidad}},{{$arrendamiento->etapa}})'>Estatus</a></li>
                                        @endif
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


<div class="modal fade" id="modal-asignar-garantias" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-asignar-garantias" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 m-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            {{-- <form action='javascript:void(0)' onsubmit=""> --}}

            <form id='modalEstado' action='{{Route("estado",0)}}' onsubmit='validateForm(this)' method='POST' class="needs-validation" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="row d-flex justify-content-center">

                        <div class="col-md-6 mt-md-0">
                            <div class="form-group">
                                <label for="id_estado"><b>Estatus</b></label>
                                <select class="form-select" id='id_estado' name='id_estado' required>
                                    <option value="" selected hidden>Seleccionar estatus</option>
                                    <option value="" disabled>Seleccionar</option>
                                    @foreach($estatus as $e)
                                    <option value="{{$e->id_estado}}">{{$e->nombre_estado}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 d-flex justify-content-center">
                    <button type="submit" class="btn btn-orange rounded-lg d-flex">
                        Guardar
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>


<script src='{{asset('js/asignacionUnidad/show.js')}}'></script>
<script src='{{asset('js/asignacionUnidad/validForm.js')}}'></script>

@endsection
