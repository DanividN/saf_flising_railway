@extends('layouts.app')

@section('content')
<?php $bol=Str::contains(url()->getRequest()->getPathInfo(),'administracion') ?>

@section($bol?'admi':'funciones', 'active')
@section('breadcrumb')   
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>{{$bol?'Administración':'Funciones'}}</small></a></span></li>
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="{{$bol?route('verificacion.indexAdministracion'):route('verificacion.indexFunciones') }}" class="rutas"><small>Verificación</small></a></span></li>
@endsection
@include('components.alertas')
    @include('funciones.verificaciones.agendarCita')
    <div class="container-fluid mt-5">

        <div class="titulo-responsive">
            <label><a>Verificación</a></label>
        </div>
        <div class="card shadow-md border-gray-100 border-0 p-2">

        {{--  --}}
            <div class="d-flex justify-content-end" style="margin-right: .5cm; margin-top:0.8cm;">
                    <a id="btn-pantcomp" href="{{route('verificacion.showInforme')}}" class="btn btn-informe">
                        Informe
                    </a>
            
                    <button class="btn btn-outline-light btn-excel boton-informexcel" 
                    style="color: #ED5429; border-color: #ED5429"
                        id="btn-responsive"
                        role="button" >
                    </button>
            </div>
            {{--  --}}

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" class="text-start encabezado">Fólio.</th>
                                <th scope="col" class="encabezado">Placas</th>
                                <th scope="col" class="encabezado">Marca</th>
                                <th scope="col" class="encabezado">Modelo - año</th>
                                <th scope="col" class="encabezado">Estatus</th>
                                <th scope="col" class="encabezado">Cliente</th>
                                <th scope="col" class="encabezado">Teléfono</th>
                                <th scope="col" class="encabezado">Número de serie</th>
                                <th scope="col" class="encabezado">Periodo de verificación</th>
                                <th scope="col" class="encabezado">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $color = [
                                'VIGENTE' => 'blue',
                                'PENDIENTE' => 'yellow',
                                'CONCLUIDO' => 'green',
                                'VENCIDO' => 'red',
                            ];
                            $cont = 1;
                            ?>
                            @foreach ($unidades as $unidad)
                                <tr class="text-center">
                                    <td class="text-start">{{ $cont++ }}</td>
                                    <td>{{ $unidad->UltimoArrendamiento->placas ?? 'No asignadas' }}</td>
                                    <td>{{ $unidad->marca->descripcion }}</td>
                                    <td>{{ $unidad->modelo }}</td>
                                    <td>
                                        <span style="display: inline-flex; align-items: center;">
                                            <span class="badge bg-{{ $color[$unidad->estado[0]] }}-status"
                                                style="height: 10px; width: 10px; border-radius: 50%; display: inline-block;"></span>
                                            <span class="text-{{ $color[$unidad->estado[0]] }}-status"
                                                style="margin-left: 5px;">{{ $unidad->estado[0] }}</span>
                                        </span>
                                    </td>
                                    <td>{{ $unidad->UltimoArrendamiento->Cliente->nombre_cliente }}</td>
                                    <td>{{ $unidad->UltimoArrendamiento->Cliente->telefono_cliente }}</td>
                                    <td>{{ $unidad->n_serie }}</td>
                                    <td data-bs-toggle="tooltip"
                                        data-bs-title="{{ $unidad->estado[1] ? 'Primer' : 'Segundo' }} semestre">
                                        {{ucwords(strtolower( $unidad->estado[1] ? $unidad->UltimoArrendamiento->primer_semestre : $unidad->UltimoArrendamiento->segundo_semestre ))}}
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle dropdown-toggle-no-caret" href="#"
                                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}"
                                                    alt="menu" style="width: 30px !important;">
                                            </a>

                                            <ul class="dropdown-menu p-0">
                                                <li><a class="dropdown-item"
                                                        href="{{ route('verificacion.informacion', $unidad->id_unidad) }}">Información</a>
                                                </li>
                                                @if (
                                                    ($unidad->estado[0] == 'PENDIENTE' || $unidad->estado[0] == 'VENCIDO') &&
                                                        (($unidad->UltimaVerificacion->estado ?? 'CONCLUIDO') == 'CONCLUIDO' ||
                                                            ($unidad->UltimaVerificacion->estado ?? '') == 'CANCELADO'))
                                                    <li><button class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#agendarCita"
                                                            onclick='modal({{ $unidad->id_unidad }})'>Agendar cita</button>
                                                    </li>
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
@endsection
