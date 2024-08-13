@extends('layouts.app')

@section('content')

@section($cita->Unidad->UltimoArrendamiento->activo == '0'?'admi':'funciones', 'active')
@section('breadcrumb')
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>{{$cita->Unidad->UltimoArrendamiento->activo == '0'?'Administración':'Funciones'}}</small></a></span></li>  
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="{{$cita->Unidad->UltimoArrendamiento->activo == '0'?route('verificacion.indexAdministracion'):route('verificacion.indexFunciones') }}" class="rutas"><small>Verificación</small></a></span></li>
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Información de unidad</small></a></span></li>            
@endsection
@include('components.alertas')

@php
$aseguradora = $cita->Unidad->datosAseguradora->aseguradora->nombre_aseguradora ?? 'Sin asignación';
$gps = $cita->Unidad->datosAseguradora->gps->nombre_gps ?? 'Sin asignación';
$no_poliza = $cita->Unidad->datosAseguradora->n_poliza ?? 'Sin asignación';
$tipo_poliza = $cita->Unidad->datosAseguradora->polizas->nombre_poliza ?? 'Sin asignación';
@endphp

<div class="container-fluid mt-5">
    @include(' components.administracion.detalleUnidad', [ 'cliente'=> $cita->arrendamiento->Cliente->nombre_cliente,
    'vehiculo' => $cita->Unidad->tipo_unidad->descripcion,
    'responsable_activo' => $cita->arrendamiento->Responsable->nombre_responsable,
    'marca' => $cita->Unidad->marca->descripcion,
    'cargo' => $cita->arrendamiento->Responsable->cargo,
    'placas' => $cita->arrendamiento->placas,
    'telefono' => $cita->arrendamiento->Responsable->telefono_responsable,
    'motor' => $cita->Unidad->n_motor,
    'idUnidad' => $cita->Unidad->vehiculo_id,
    'gps' => $gps,
    'no_poliza' => $no_poliza,
    'aseguradora' => $aseguradora,
    'tipo_poliza' => $tipo_poliza,
    ])
    <div class="card shadow-md mt-4 border-0 p-2">
        <div class="card-body">
            <fieldset class="card-body" {{ $cita->estado == 'CANCELADO' || $cita->estado == 'CONCLUIDO' ? 'disabled' : '' }}>
                <form id='formSeguimiento' action='{{ Route('verificacion.store', $cita->id_citas_verificaciones) }}' onsubmit='validateForm(this)' method='POST' class="needs-validation" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="row">

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="id_holograma"><b>Holograma</b><span class="text-danger">*</span></label>
                                <select class="menu" id="id_holograma" name='id_holograma' required>
                                    <option value="" selected hidden>Seleccionar</option>
                                    <option value="" disabled>Seleccionar</option>
                                    @foreach ($hologramas as $holograma)
                                    <option value="{{ $holograma->id_holograma }}" {{ (old('id_holograma') ?? ($cita->Seguimiento->id_holograma ?? -1)) == $holograma->id_holograma ? 'selected' : '' }}>
                                        {{ $holograma->descripcion }}</option>
                                    @endforeach
                                </select>
                                @error('id_holograma')
                                <div class='text-danger my-2'>
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="invalid-feedback text-danger my-2">
                                    El holograma es invalido
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="periodo"><b>Periodo de verificación</b></label>
                                <input type="text" class="form-control" name='periodo' value="{{ $cita->Seguimiento->periodo ?? ($cita->Unidad->estado[1] ? 'PRIMER' : 'SEGUNDO') . ' PERIODO' }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="fecha_verificacion"><b>Fecha de verificación</b><span class="text-danger">*</span></label>
                                <input type="" class="datepicker form-control" name='fecha_verificacion' value='{{ old('fecha_verificacion') ?? ($cita->Seguimiento->fecha_verificacion ?? '') }}' placeholder="mm/dd/aaaa" required>
                                @error('fecha_verificacion')
                                <div class='text-danger my-2'>
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="invalid-feedback text-danger my-2">
                                    La fecha de verificación es invalida
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="year_verificacion"><b>Año en curso</b></label>
                                <input type="text" class="form-control" value="{{ $cita->Seguimiento->year_verificacion ?? date('Y') }}" name='year_verificacion' readonly>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="monto_verificacion"><b>Monto de verificación</b><span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="text" class="form-control cantidad" name="monto_verificacion" value='{{ old('monto_verificacion') ?? ($cita->Seguimiento->monto_verificacion ?? '') }}' required>
                                    <div class="invalid-feedback text-danger my-2">
                                        El monto de verificación es invalido
                                    </div>
                                </div>
                                @error('monto_verificacion')
                                <div class='text-danger my-2'>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="a_evidencia_verificacion"><b>Evidencia</b></label>
                                <div class="input-group mb-3">
                                    @isset($cita->Seguimiento->a_evidencia_verificacion)
                                    <span class="input-group-text" style='background-color: #ED5429;color: white; border-color: #ED5429;'>
                                        <a style='color: white;' href="{{ asset('storage/' . $cita->Seguimiento->a_evidencia_verificacion) }}" target="_blank">
                                            <i class="bi bi-download"></i>
                                        </a>
                                    </span>
                                    @endisset
                                    <input type="file" accept=".pdf" class="input-archivo-down input-archivo" name='a_evidencia_verificacion'>
                                </div>
                                @error('a_evidencia_verificacion')
                                <div class='text-danger my-2'>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <hr class="mt-4 mb-2">

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="multa_verificacion"><b>Multa</b><span class="text-danger">*</span></label>
                                <select class="menu" name='multa_verificacion' onchange='multa(this.value)' required>
                                    <option value="" selected hidden>Seleccionar</option>
                                    <option disabled>Seleccionar</option>
                                    <option value='1' {{ (old('multa_verificacion') ?? ($cita->Seguimiento->multa_verificacion ?? '')) == '1' ? 'selected' : '' }}>
                                        Si</option>
                                    <option value='0' {{ (old('multa_verificacion') ?? ($cita->Seguimiento->multa_verificacion ?? '')) == '0' ? 'selected' : '' }}>
                                        No</option>
                                </select>
                                @error('multa_verificacion')
                                <div class='text-danger my-2'>
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="invalid-feedback text-danger my-2">
                                    La multa es invalida
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="monto_multa"><b>Monto multa</b><span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="text" class="form-control cantidad" id="monto_multa" name="monto_multa" value='{{ old('monto_multa') ?? ($cita->Seguimiento->monto_multa ?? '') }}'>
                                    <div class="invalid-feedback text-danger my-2">
                                        La multa es invalida
                                    </div>
                                </div>
                                @error('monto_multa')
                                <div class='text-danger my-2'>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="a_comprobante_multa"><b>Comprobante multa</b></label>
                                <div class="input-group mb-3">
                                    @isset($cita->Seguimiento->a_comprobante_multa)
                                    <span class="input-group-text" style='background-color: #ED5429;color: white; border-color: #ED5429;'>
                                        <a style='color: white;' href="{{ asset('storage/' . $cita->Seguimiento->a_comprobante_multa) }}" target="_blank">
                                            <i class="bi bi-download"></i>
                                        </a>
                                    </span>
                                    @endisset
                                    <input type="file" accept=".pdf" class="input-archivo-down input-archivo" name='a_comprobante_multa' id='a_comprobante_multa'>
                                </div>
                                @error('a_comprobante_multa')
                                <div class='text-danger my-2'>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Estatus</b><span class="text-danger">*</span></label>
                                <select class="menu" id="id_holograma" name='estado' onchange='estatus(this.value)'>
                                    <option value="" selected hidden>Seleccionar</option>
                                    <option value="" disabled>Seleccionar</option>
                                    <option value="CANCELADO" {{ $cita->estado == 'CANCELADO' ? 'selected' : '' }}>Cancelado
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 mt-4">
                            <div class="form-group">
                                <label for="descripcion"><b>Observaciones</b></label>
                                <textarea class="form-control" rows="5" name='descripcion' value='{{ old('descripcion') ?? ($cita->Seguimiento->descripcion ?? '') }}'></textarea>
                            </div>
                            @error('descripcion')
                            <div class='text-danger my-2'>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    @if (!($cita->estado == 'CANCELADO' || $cita->estado == 'CONCLUIDO'))
                    <div class="d-flex justify-content-center gap-4 mt-4">
                        @include('components.btn-regresar', [
                        'link' => 'verificacion.informacion',
                        'params' => $cita->Unidad->id_unidad,
                        ])
                        @include('components.btn-guardar', ['link' => 'tenencias.index'])
                    </div>
                    @endif
                </form>
            </fieldset>

            @if ($cita->estado == 'CANCELADO' || $cita->estado == 'CONCLUIDO')
            <div class="d-flex justify-content-center gap-4 mb-4">
                @include('components.btn-regresar', [
                'link' => 'verificacion.informacion',
                'params' => $cita->Unidad->id_unidad,
                ])
            </div>
            @endif
        </div>
    </div>
</div>

<script src='{{ asset('js/input-file.js') }}'></script>
<script src='{{ asset('js/verificacion/show.js') }}'></script>
<script src='{{asset('js/asignacionUnidad/validForm.js')}}'></script>
@endsection
