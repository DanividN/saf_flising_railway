@extends('layouts.app')

@section('content')
@section($unidad->UltimoArrendamiento->activo == '0'?'admi':'funciones', 'active')
@section('breadcrumb')       
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>{{$unidad->UltimoArrendamiento->activo == '0'?'Administración':'Funciones'}}</small></a></span></li>            
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="{{$unidad->UltimoArrendamiento->activo == '0'?route('verificacion.indexAdministracion'):route('verificacion.indexFunciones') }}" class="rutas"><small>Verificación</small></a></span></li>
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Agregar verificación</small></a></span></li>            
@endsection
@include('components.alertas')
@include('funciones.verificaciones.agendarCita')
<div class="container-fluid mt-5">
    <div class="titulo-responsive">
        <label><a>Información de Unidad</a></label>
    </div>
    <div class="card shadow-md border-gray-100 border-0 p-2">

        {{-- botones--------------------------------- --}}
        <div class="card-header bg-white border-0 d-flex justify-content-end justify-content-md-end gap-2 mt-5" style="">
            {{-- ---boton llamada------------------------ --}}

            @if ($unidad->UltimoArrendamiento->activo == '1')
            <a href="#" class="btn btn-informe-orange boton-telefono" id="btn-phonepantallacomp" data-bs-toggle="modal" data-bs-target="#miRegistroModal">
                &nbsp; &nbsp; &nbsp; Mi registro
            </a>

            <a href="#" class="btn btn-informe-orange boton-telefono" id="btn-phonepantrespons" data-bs-toggle="modal" data-bs-target="#miRegistroModal">
            </a>
            @endif

            {{-- --------------------------------------- --}}
            {{-- -----------BOTON descargar informe----------------- --}}
            <a href="{{ route('verificaciones.dowload', $unidad->id_unidad) }}" class="btn btn-informe-orange boton-descargarInforme" id="btn-infor-pantcomplet">
                &nbsp; &nbsp; &nbsp; Descargar informe
            </a>


            <a href="" class="btn btn-informe-orange boton2 boton-descargarInforme" id="btn-infor-responsive">
            </a>
            {{-- ---------------------BOTON maS+------------------------ --}}
            <?php 
            $block=true;
            if (
            ($unidad->estado[0] == 'PENDIENTE' || $unidad->estado[0] == 'VENCIDO') &&
            (($unidad->UltimaVerificacion->estado ?? 'CONCLUIDO') == 'CONCLUIDO' ||
            ($unidad->UltimaVerificacion->estado ?? '') == 'CANCELADO'))
                $block=false;
            ?>
            <button type="button" class="btn boton-principal" id="btn-agregarcitpantComp" data-bs-toggle="modal" data-bs-target="#agendarCita" {{$block?'disabled':''}}>
                <i class="fas fa-plus"></i> Agregar cita
            </button>

            <button type="button" class="btn boton-principal" id="btn-agregarResponsive" data-bs-toggle="modal" data-bs-target="#agendarCita" {{$block?'disabled':''}}>
                <i class="fas fa-plus"></i>
            </button>
        </div>
        {{-- ------------------------------ --}}



        {{-- modal --}}
        <div class="modal fade" id="miRegistroModal" tabindex="-1" aria-labelledby="miRegistroModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <!-- Cambia a modal-lg o modal-xl -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="miRegistroModalLabel" style="color:#ED5429;">Información de Unidad
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form id='miRegistro' action="{{ route('verificacion.miRegistro', $unidad->id_unidad ?? 0) }}" method='POST' onsubmit='blockBtnMiCall(this)' class="needs-validation" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong class="info-item">Cliente:
                                            {{ $unidad->UltimoArrendamiento->Cliente->nombre_cliente }}</strong><br />
                                        <strong class="info-item">Responsable de Activo:
                                            {{ $unidad->UltimoArrendamiento->Responsable->nombre_responsable }}</strong><br />
                                        <strong class="info-item">Cargo:
                                            {{ $unidad->UltimoArrendamiento->Responsable->cargo }}</strong><br />
                                        <strong class="info-item">Teléfono:
                                            {{ $unidad->UltimoArrendamiento->Responsable->telefono_responsable }}</strong>
                                    </div>
                                    <div class="col-md-6">
                                        <strong class="info-item">ID. Unidad: {{ $unidad->vehiculo_id }}</strong><br />
                                        <strong class="info-item">Marca:
                                            {{ $unidad->marca->descripcion }}</strong><br />
                                        <strong class="info-item">Placas:
                                            {{ $unidad->UltimoArrendamiento->placas }}</strong>
                                    </div>
                                </div>

                                <hr style="color: #929292dd">

                                <div class="row">
                                    <h4 style="color:#ED5429; text-align:left;">Registro de Atención</h4>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="tipo_poliza" class="form-label"><b>Tipo de llamada</b></label>
                                        <input class="form-check-input" type="radio" name="tipo_llamada" value='0' required>
                                        <label class="form-check-label" for="tipo_llamada">
                                            Agenda
                                        </label>
                                        <input class="form-check-input" type="radio" name="tipo_llamada" value='1' required>
                                        <label class="form-check-label" for="tipo_llamada">
                                            Registro
                                        </label>
                                        @error('tipo_llamada')
                                        <div class='text-danger'>
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <div class="invalid-feedback text-danger my-2">
                                            El tipo de llamada es invalido
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="estatus" class="form-label"><b>Estatus</b></label>
                                        <input class="form-check-input" type="radio" name="estatus" value='Atendido' required>
                                        <label class="form-check-label" for="estatus">
                                            Atendido
                                        </label>
                                        <input class="form-check-input" type="radio" name="estatus" value='No Atendido' ççç>
                                        <label class="form-check-label" for="estatus">
                                            No atendido
                                        </label>
                                        @error('estatus')
                                        <div class='text-danger'>
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <div class="invalid-feedback text-danger my-2">
                                            El estatus es invalido
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Fecha:</label>
                                        <input class="form-control datepicker" type="text" placeholder="mm/dd/aaaa" value='{{ Carbon\Carbon::now('America/Mexico_City')->format('d/m/Y') }}' disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Hora:</label>
                                        <input class="form-control" type="text" placeholder="00:00:00" value='{{ Carbon\Carbon::now('America/Mexico_City')->format('H:i A') }}' disabled>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Usuario:</label>
                                        <input class="form-control" type="text" placeholder="Usuario" value='{{ Auth::user()->name }}' disabled>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Observaciones:</label>
                                        <textarea class="form-control" rows="3" name='descripcion' placeholder="Ingrese aquí sus observaciones" required></textarea>
                                        @error('descripcion')
                                        <div class='text-danger my-2'>
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <div class="invalid-feedback text-danger my-2">
                                            La descripcion es invalida
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            {{-- <button type="button" class="btn btn-principal-corto btn-flis-corto" data-bs-dismiss="modal">Cerrar</button> --}}
                            <button id='GuardarBtn' type="submit" class="btn btn-orange btn-flis-corto">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ------- --}}

        <div class="card-body">
            <div class="table-responsive">
                <?php
                    $color = [
                        'AGENDADO' => 'blue',
                        'CONCLUIDO' => 'green',
                        'VENCIDO' => 'red',
                        'CANCELADO' => 'red',
                    ];
                    ?>
                <table class="table" id="table">
                    <thead>
                        <tr class="text-center">
                            <th scope="col" class="text-start encabezado">Folio</th>
                            <th scope="col" class="encabezado">Placas</th>
                            <th scope="col" class="encabezado">Marca</th>
                            <th scope="col" class="encabezado">Cliente</th>
                            <th scope="col" class="encabezado">Fecha de pago</th>
                            <th scope="col" class="encabezado">Monto</th>
                            <th scope="col" class="encabezado">Cita</th>
                            <th scope="col" class="encabezado">Evidecia</th>
                            <th scope="col" class="encabezado">Estatus</th>
                            <th scope="col" class="encabezado">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($unidad->HistorialVerificacion as $cita)
                        <tr class="text-center">
                            <td class="text-start">{{ $cita->folio }}</td>
                            <td>{{ $cita->arrendamiento->placas }}</td>
                            <td>{{ $unidad->marca->descripcion }}</td>
                            <td>{{ $cita->arrendamiento->Cliente->nombre_cliente }}</td>
                            <td>{{ $cita->Seguimiento->fecha_verificacion ?? 'Pendiente' }}</td>
                            <td>{{ ($cita->Seguimiento->monto_verificacion??0)==0?'Pendiente': '$' .number_format($cita->Seguimiento->monto_verificacion) }}</td>
                            <td>
                                <a style='color: white;' href="{{ asset('storage/' . $cita->a_cita) }}" target="_blank">
                                    <img src="{{ asset('img/configuracion/pdf.png') }}" alt="icono.pdf" width="23px">
                                </a>
                            </td>
                            <td>
                                @isset($cita->Seguimiento->a_evidencia_verificacion)
                                <a style='color: white;' href="{{ asset('storage/' . $cita->Seguimiento->a_evidencia_verificacion) }}" target="_blank">
                                    <img src="{{ asset('img/configuracion/pdf.png') }}" alt="icono.pdf" width="23px">
                                </a>
                                @endisset
                            </td>
                            <td>
                                <span style="display: inline-flex; align-items: center;">
                                    <span class="badge bg-{{ $color[$cita->estado] }}-status status" style="border-radius: 50%; display: inline-block;"></span>
                                    <span class="text-{{ $color[$cita->estado] }}-status" style="margin-left: 5px;">{{ $cita->estado }}</span>
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <a class="dropdown-toggle dropdown-toggle-no-caret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}" alt="menu" style="width: 30px !important;">
                                    </a>

                                    <ul class="dropdown-menu p-0">
                                        <li><a class="dropdown-item" href="{{ route('verificacion.show', $cita->id_citas_verificaciones) }}">Ver</a>
                                        </li>
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
