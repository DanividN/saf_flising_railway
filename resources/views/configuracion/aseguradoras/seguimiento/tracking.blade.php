@extends('layouts.app')

@section('content')

@include('components.alertas')
<div class="container-fluid mt-5">
    <div class="titulo-responsive">
        <label><a>Lista de Pólizas</a></label>
    </div>
    <div class="card">
        <div class="card-body text-gray">
            <p><span style="color:black; font-size:18px;"><strong>Nombre aseguradora: </strong> </span> {{$aseguradora[0]->nombre_aseguradora}}</p>
            <p><span style="color:black; font-size:18px;"><strong>Razón Social: </strong> </span> {{$aseguradora[0]->razon_aseguradora}}</p>
            <p><span style="color:black; font-size:18px;"><strong>RFC: </strong> </span> {{$aseguradora[0]->rfc_aseguradora}}</p>
            <p><span style="color:black; font-size:18px;"><strong>Fecha de registro: </strong> </span> {{$aseguradora[0]->created_at}}</p>
            <p><span style="color:black; font-size:18px;"><strong>Teléfono: </strong> </span> {{$aseguradora[0]->telefono_aseguradora}}</p>
            <p><span style="color:black; font-size:18px;"><strong>Municipio: </strong> </span>
                @foreach ($municipios as $municipio)
                    @if($municipio->id_municipio == $aseguradora[0]->id_municipio)
                        {{ $municipio->nombre_municipio }}
                    @endif
                @endforeach
            </p>
        </div>
    </div>
    <div class="card mt-2">
        <div class="d-flex justify-content-end" style="margin-left: .4cm; margin-top: .1cm">
            <button type="button" class="btn boton-principal me-3 mt-4" data-bs-toggle="modal" data-bs-target="#exampleModal"
                    id="btn-pantcomp">
                    <i class="bi bi-plus-lg"></i> Agregar Póliza
            </button>

            <button type="button" class="btn btn-informe me-3 mt-4" data-bs-toggle="modal" data-bs-target="#exampleModal"
                id="btn-responsive">
                <i class="bi bi-plus-lg"></i>
            </button>

            <!-- Modal -->
            @include('configuracion.aseguradoras.seguimiento.tracking_modal')
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th scope="col" class="encabezado">No.</th>
                            <th scope="col" class="encabezado">Tipo de póliza</th>
                            <th scope="col" class="encabezado">Porcentaje de daño material</th>
                            <th scope="col" class="encabezado">Porcentaje robo total</th>
                            <th scope="col" class="encabezado">Evidencia</th>
                            <th scope="col" class="encabezado">Estado</th>
                            <th scope="col" class="encabezado">Acción</th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center">
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($polizas as $poliza)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{$poliza->nombre_poliza}}</td>
                                <td>{{$poliza->dano_material}}%</td>
                                <td>{{$poliza->robo_total}}%</td>
                                <td>
                                    <a href="{{url('storage/'.$poliza->a_poliza)}}"
                                        class="boton-pdf"
                                         target="__blank">

                                    </a>
                                </td>
                                <td>
                                    @if ($poliza->activo == 1)
                                        <span style="display: inline-flex; align-items: center;">
                                            <span class="badge bg-green-status status" style="border-radius: 50%; display: inline-block;"></span>
                                            <span class="text-green-status" style="margin-left: 5px;">Activo</span>
                                        </span>
                                    @else
                                        <span style="display: inline-flex; align-items: center;">
                                            <span class="badge bg-red-status status" style="border-radius: 50%; display: inline-block;"></span>
                                            <span class="text-red-status" style="margin-left: 5px;">Inactivo</span>
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <a class="dropdown-toggle dropdown-toggle-no-caret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}" alt="menu" style="width: 30px !important;">
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{$poliza->id_poliza_seguro}}">
                                            <li>
                                                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal{{$poliza->id_poliza_seguro}}">
                                                    Editar
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Modal -->
                                    @include('configuracion.aseguradoras.seguimiento.tracking_modal_edit')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src='{{asset('js/polizasSeguros/estatusChecks.js')}}'></script>
<script src='{{asset('js/input-file.js')}}'></script>
<script src='{{asset('js/validacionCampos.js')}}'></script>
@endsection


