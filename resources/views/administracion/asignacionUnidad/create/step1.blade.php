@extends('layouts.app')
@section('content')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2-bootstrap-5-theme.min.css') }}">
@endsection
@section('scripts')
<script defer src="{{ asset('assets/plugins/select2-4.1/js/select2.min.js') }}"></script>
<script defer src="{{ asset('js/select2.js') }}"></script>
@endsection

@include('components.alertas')

@if(session('unidad'))
<div id='message'>
    {{session('unidad')}}
</div>
@endif
@section('admi', 'active')
@section('breadcrumb')       
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Administración</small></a></span></li>            
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="{{ route('asignacionUnidades.index') }}" class="rutas"><small>Asignación de unidades</small></a></span></li>            
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Asignación</small></a></span></li>            
@endsection


{{-- paso 1 --}}


<div class="container-fluid mt-5">
    <div class="d-block d-md-none label">Asignación - 1</div>
    <div class="card shadow-md border-gray-100 border-0 p-2">
        @include('components.administracion.detalleArrendamiento', [
        'arrendamiento' => (object) ['etapa' => 0],
        ])

        <div class="card-body">

            <form id='form 1' action='{{Route("store1")}}' method='POST' class="needs-validation" novalidate>
                @csrf

                <div class="row">

                    <div class="col-md-4 mb-4">
                        <div class="form-group">
                            <label for="id_cliente"><b>Cliente:</b><span class="text-danger">*</span></label>
                            <select class="single-select-field" id="id_cliente" name='id_cliente' onchange="searchResponsables(this.value)" required>
                                <option value="" selected hidden>Seleccionar cliente</option>
                                <option disabled>Seleccionar cliente</option>
                                @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id_cliente }}" {{(old('id_cliente')??$_GET['cliente']??null)== $cliente->id_cliente ?'selected':''}}>{{ $cliente->nombre_cliente }}</option>
                                @endforeach
                            </select>
                            @error('id_cliente')
                            <div class='text-danger my-2'>
                                {{ str_replace('id cliente','cliente',$message) }}
                            </div>
                            @enderror
                            <div class="invalid-feedback text-danger my-2">
                                El cliente es invalido
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="form-group">
                            <label for="id_unidad">ID Unidad:</label>
                            <select class="single-select-field" id="id_unidad" name='id_unidad' required>
                                <option value="" selected hidden>Seleccionar unidad</option>
                                <option disabled>Seleccionar unidad</option>
                                @foreach($unidades as $unidad)
                                <option value="{{ $unidad->id_unidad }}" {{old('id_unidad') == $unidad->id_unidad ?'selected':''}}>{{ $unidad->vehiculo_id }}</option>
                                @endforeach
                            </select>
                            @error('id_unidad')
                            <div class='text-danger my-2'>
                                {{ str_replace('id unidad','unidad',$message) }}
                            </div>
                            @enderror
                            <div class="invalid-feedback text-danger my-2">
                                La id unidad es invalido
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="form-group">
                            <label for="id_responsable">Responsable de Activo:</label>
                            <select class="single-select-field" id="id_responsable" name='id_responsable' old="{{old('id_responsable')}}" required>
                                <option value="" selected hidden>Seleccionar responsable</option>
                                <option disabled>Seleccionar responsable</option>
                                <!-- Opciones del select para Responsable de Activo -->
                            </select>
                            @error('id_responsable')
                            <div class='text-danger my-2'>
                                {{ str_replace('id responsable','responsable',$message) }}
                            </div>
                            @enderror
                            <div class="invalid-feedback text-danger my-2">
                                El responsable es invalido
                            </div>
                        </div>
                    </div>
                </div>

                <hr />

                <div class="row">

                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for="plazo_arrendamiento">Plazo de Arrendamiento:</label>
                            <select class="form-select" id="plazo_arrendamiento" name='plazo_arrendamiento' onchange='getFechaFinal()' required>
                                <option value="" selected hidden>Seleccionar plazo</option>
                                <option disabled>Seleccionar plazo</option>
                                @foreach($plazos as $plazo)
                                <option value="{{ $plazo->id_plazo }}" {{old('plazo_arrendamiento') == $plazo->id_plazo ?'selected':''}}>{{ $plazo->plazo }}</option>
                                @endforeach
                            </select>
                            @error('plazo_arrendamiento')
                            <div class='text-danger my-2'>
                                {{ str_replace('plazo_arrendamiento','arrendamiento',$message) }}
                            </div>
                            @enderror
                            <div class="invalid-feedback text-danger my-2">
                                El plazo es invalido
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for=""><b>Fecha Inicial:</b><span class="text-danger">*</span></label>
                            <input type="date" id="fecha_inicial" name='fecha_inicial' class="form-control" value="{{old('fecha_inicial')}}" onchange='getFechaFinal()' required>
                            @error('fecha_inicial')
                            <div class='text-danger my-2'>
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="invalid-feedback text-danger my-2">
                                La fecha inicial es invalida
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mt-4">
                        <div class="form-group">
                            <label for=""><b>Fecha Final:</b><span class="text-danger">*</span></label>
                            <input type="date" id="fecha_final" name='fecha_final' class="form-control" value="{{old('fecha_final')}}" required>
                            @error('fecha_final')
                            <div class='text-danger my-2'>
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="invalid-feedback text-danger my-2">
                                La fecha final es invalida
                            </div>
                        </div>
                    </div>

                </div>

                <div class="d-flex justify-content-center gap-4 mt-4">
                @isset($_GET['cliente'])
                    <x-btn-regresar link='asignacionUnidades.show' params="{{$_GET['cliente']}}" text='Anterior' />
                @endisset
                    <input type='button' class="btn-enviar" onclick="validarFormulario()" value='Continuar'>
                    <x-btn-regresar link='asignacionUnidades.index' text='Salir' />

                    <div class="modal fade" id="modalAsignacionUnidades" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-asignar-garantias" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header border-0 m-0">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="border-0 d-flex justify-content-center">
                                    <h5 class="modal-title" id="staticBackdropLabel">¿Estás seguro de agregar este registro?</h5>
                                </div>

                                <div class="modal-body text-red-status">
                                    <center>
                                        Una vez agregado, este registro formará parte de la base de datos y no podrá ser editado posteriormente.
                                        <br>
                                        <br>
                                        Por favor, confirma que deseas proceder con esta acción.
                                    </center>
                                </div>
                                <div class="modal-footer border-0 d-flex justify-content-center">
                                    <input type='button' class="btn btn-regresar" data-bs-toggle="modal" data-bs-target="#modal-asignar-garantias" value='Cancelar'>
                                    <x-btn-enviar text='Confirmar' />
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<script src='{{asset('js/asignacionUnidad/validForm.js')}}'></script>
<script src='{{asset('js/asignacionUnidad/step1.js')}}'></script>

@endsection
