@extends('layouts.app')
@section('admi', 'active')
@section('breadcrumb')
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href=""
                class="rutas"><small>Administración</small></a></span></li>
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="{{ route('unidadTenencia.index') }}"
                class="rutas"><small>Tenencias</small></a></span></li>
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="{{ route('unidadTenencia.index') }}"
                class="rutas"><small>Agregar Tenencia</small></a></span></li>
@endsection
@section('content')
    @include('components.alertas')

    <div class="container-fluid mt-5">
        <div class="titulo-responsive">
            <label><a>Información de Unidad</a></label>
        </div>
        @include('components.administracion.detalleUnidad', [
            'cliente' => $unidad->UltimoArrendamiento->Cliente->nombre_cliente ?? 'Sin asignación',
            'vehiculo' => $unidad->tipo_unidad->descripcion ?? 'Sin asignación',
            'responsable_activo' =>
                $unidad->UltimoArrendamiento->Cliente->responsable->nombre_responsable ?? 'Sin asignación',
            'cargo' => $unidad->UltimoArrendamiento->Cliente->responsable->cargo ?? 'Sin asignación',
            'telefono' =>
                $unidad->UltimoArrendamiento->Cliente->responsable->telefono_responsable ?? 'Sin asignación',
            'idUnidad' => $unidad->vehiculo_id ?? 'Sin asignación',
            'marca' => $unidad->marca->descripcion ?? 'Sin asignación',
            'tipo_poliza' => $unidad->datosAseguradora->polizas->nombre_poliza ?? 'Sin asignación',
            'placas' => $unidad->UltimoArrendamiento->placas ?? 'Sin asignación',
            'motor' => $unidad->n_motor ?? 'Sin asignación',
            'no_poliza' => $unidad->datosAseguradora->n_poliza ?? 'Sin asignación',
            'gps' => $unidad->datosAseguradora->nombre_gps ?? 'Sin asignación',
            'aseguradora' => $unidad->datosAseguradora->aseguradora->nombre_aseguradora ?? 'Sin asignación',
        ])

        <div class="card shadow-md mt-4 border-0 p-2">
            <div class="card-body">
                <form action="{{ route('tenencias.store') }}" method="post" class="needs-validation" id="formulario"
                    novalidate enctype="multipart/form-data" onsubmit="return bloqueoBoton(event)">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="datepicker"><b>Fecha de pago</b><span class="text-danger">*</span></label>
                                <input type="text" name="fecha_pago" id="datepicker" class="form-control datepicker"
                                    placeholder="dd/mm/aaaa" required value="{{ old('fecha_pago') }}">
                                <div class="invalid-feedback text-danger" style="margin:10px 0px;">
                                    <p class="text-danger">La fecha de pago no es valido</p>
                                    @error('fecha_pago')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="cantidad"><b>Monto con IVA</b><span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background: #999998;"><i
                                            class="bi bi-currency-dollar" style="color:white;"></i></span>
                                    <input type="text" name="monto_tenencia" class="form-control cantidad"
                                        placeholder="Ingrese la cantidad" aria-label="Monto con IVA"
                                        aria-describedby="basic-addon" value="{{ old('monto_tenencia') }}" required
                                        pattern="[0-9\,]{1,}">
                                        <div class="invalid-feedback text-danger" style="margin:10px 0px; ">
                                            <p class="text-danger">El monto con iva no es valido</p>
                                            @error('monto_tenencia')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="evidencia"><b>Evidencia</b><span class="text-danger">*</span></label><br>
                                <input type="file" name="a_evidencia_tenencia" class="input-archivo" id="evidencia"
                                    required>
                                    <div class="invalid-feedback text-danger" style="margin:10px 0px; ">
                                        <p class="text-danger">La evidencia no es valido</p>
                                        @error('a_evidencia_tenencia')
                                            {{ $message }}
                                        @enderror
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-4">
                        <div class="form-group">
                            <label for=""><b>Observaciones</b></label>
                            <textarea name="observacion" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
            </div>
            <div class="d-flex justify-content-center gap-4 mt-4">
                @include('components.btn-regresar', ['link' => 'tenencias.index'])
                @include('components.btn-guardar', ['link' => 'tenencias.store', 'id' => 'guardarBtn'])
            </div>
            </form>
        </div>
    </div>
    <script src='{{ asset('js/input-file.js') }}'></script>
    <script src="{{ asset('js/botonBloqueo.js') }}"></script>
    <script>
        document.getElementById('formulario').addEventListener('submit', function(event) {
            var inputFile = document.getElementById('evidencia');

            if (!inputFile.value) {
                inputFile.style.border = '1px solid #941a25';
                event.preventDefault(); // Evita el envío del formulario si el archivo no está seleccionado
            } else {
                inputFile.style.border = '1px solid #198754';
            }
        });
    </script>
@endsection
