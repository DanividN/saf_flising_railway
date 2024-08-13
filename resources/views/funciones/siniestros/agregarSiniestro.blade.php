@extends('layouts.app')
@section('funciones','active')
@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Funciones</small></a></span></li>
<li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="{{route('asignacionSiniestro.index')}}" class="rutas"><small>Siniestros</small></a></span></li>
<li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Agregar siniestros</small></a></span></li>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2-bootstrap-5-theme.min.css') }}">
@endsection
@section('scripts')
    <script defer src="{{ asset('assets/plugins/select2-4.1/js/select2.min.js') }}"></script>
    <script defer src="{{ asset('js/select2.js') }}"></script>
    <script src="{{ asset('js/botonBloqueo.js') }}"></script>
@endsection
@section('content')
    @include('components.alertas')

    <div class="container-fluid mt-5">
        <div class="titulo-responsive">
            <label><a>Informacion de Unidad</a></label>
        </div>
        @include('components.administracion.detalleUnidad', [
             'cliente' => $registro->cliente->nombre_cliente ?? 'Sin asignación',
            'vehiculo' => $registro->unidad->tipo_unidad->descripcion ?? 'Sin asignación',
            'responsable_activo' => $registro->cliente->responsable->nombre_responsable ?? 'Sin asignación',
            'cargo' => $registro->cliente->responsable->cargo ?? 'Sin asignación',
            'telefono' => $registro->cliente->responsable->telefono_responsable ?? 'Sin asignación',
            'idUnidad' => $registro->unidad->vehiculo_id ?? 'Sin asignación',
            'marca' => $registro->unidad->marca->descripcion ?? 'Sin asignación',
            'tipo_poliza' => $registro->unidad->datosAseguradora->polizas->nombre_poliza ?? 'Sin asignación',
            'placas' => $registro->unidad->UltimoArrendamiento->placas ?? 'Sin asignación',
            'motor' => $registro->unidad->n_motor ?? 'Sin asignación',
            'no_poliza' => $registro->unidad->datosAseguradora->n_poliza ?? 'Sin asignación',
            'gps' => $registro->unidad->datosAseguradora->nombre_gps ?? 'Sin asignación',
            'aseguradora' => $registro->unidad->datosAseguradora->aseguradora->nombre_aseguradora ?? 'Sin asignación',
        ])

        <div class="card shadow-md mt-5 border-0 p-2">
            <div class="card-body">
                <form action="{{route('asignacionSiniestro.update',$registro)}}" method="POST" enctype="multipart/form-data" class="needs-validation" id="formulario" novalidate onsubmit="return bloqueoBoton(event)">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Aseguradora</b></label>
                                <input type="text" class="form-control" placeholder="Aseguradora" value="{{ $registro->unidad->datosAseguradora->aseguradora->nombre_aseguradora }}" disabled>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Tipo de póliza</b></label>
                                <input type="text" class="form-control" placeholder="Tipo de póliza" value="{{ $registro->unidad->datosAseguradora->polizas->nombre_poliza }}" disabled>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                              <label for=""><b>Monto deducible</b></label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">$</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Monto deducible" value="{{ $registro->unidad->datosAseguradora->monto_deducible_seguro }}" disabled>
                              </div>
                            </div>
                          </div>


                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Fecha de siniestro</b></label>
                                <input type="text" name="fecha_siniestro" class="datepicker form-control" placeholder="dd/mm/aaaa" required>
                                <div class="invalid-feedback" style="margin:10px 0px;">
                                    <p class="text-danger">La fecha del siniestro no es valido</p>
                                </div>
                                <div class="text-danger"style="margin:10px 0px;">
                                    @error('fecha_siniestro')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Siniestro</b></label>
                                <select class="single-select-field" name="id_siniestro" required>
                                    <option value="" hidden>-- Selecciona una opción --</option>
                                    @foreach ($siniestros as $siniestro )
                                        <option value="{{ $siniestro->id_siniestro }}">{{ $siniestro->nombre }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"style="margin:10px 0px;">
                                    <p class="text-danger">El siniestro no es valido</p>
                                </div>
                                <div class="text-danger"style="margin:10px 0px;">
                                    @error('id_siniestro')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for=""><b>Evidencia</b></label>
                                <input type="file" name="a_evidencia_siniestro" class="input-archivo" placeholder="Evidencia" id="a_evidencia_siniestro" required>
                                <div class="invalid-feedback" style="margin:10px 0px;">
                                    <p class="text-danger">La evidencia no es valido</p>
                                </div>
                                <div class="text-danger" style="margin:10px 0px;">
                                    @error('a_evidencia_siniestro')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-4">
                            <div class="form-group">
                                <label for=""><b>Observaciones</b></label>
                                <textarea name="observaciones" class="form-control" rows="3" placeholder="Observaciones"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-4 mt-4">
                        @include('components.btn-enviar', [
                            'link' => 'tenencias.index','id'=>'guardarBtn'])
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('formulario').addEventListener('submit', function(event) {
            var inputFile = document.getElementById('a_evidencia_siniestro');

            if (!inputFile.value) {
                inputFile.style.border = '1px solid #941a25';
                event.preventDefault(); // Evita el envío del formulario si el archivo no está seleccionado
            } else {
                inputFile.style.border = '1px solid #198754';
            }
        });
    </script>
@endsection
