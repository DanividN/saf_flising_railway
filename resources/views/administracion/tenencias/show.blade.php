@extends('layouts.app')

@section('content')
    @include('components.alertas')

    <div class="container-fluid mt-5">
        <div class="titulo-responsive">
            <label><a>Información de Unidad</a></label>
        </div>
        @include('components.administracion.detalleUnidad', [
            'cliente' => $tenencia->arrendaminto->Cliente->nombre_cliente ?? 'Sin asignación',
            'responsable_activo' =>
                $tenencia->arrendaminto->Cliente->responsable->nombre_responsable ?? 'Sin asignación',
            'cargo' => $tenencia->arrendaminto->Cliente->responsable->cargo ?? 'Sin asignación',
            'telefono' => $tenencia->arrendaminto->Cliente->responsable->telefono_responsable ?? 'Sin asignación',
            'idUnidad' => $tenencia->unidad->vehiculo_id ?? 'Sin asignación',
            'vehiculo' => $tenencia->unidad->tipo_unidad->descripcion ?? 'Sin asignación',
            'marca' => $tenencia->unidad->marca->descripcion ?? 'Sin asignación',
            'tipo_poliza' => $tenencia->unidad->datosAseguradora->polizas->nombre_poliza ?? 'Sin asignación',
            'placas' => $tenencia->arrendaminto->placas ?? 'Sin asignación',
            'motor' => $tenencia->unidad->n_motor ?? 'Sin asignación',
            'no_poliza' => $tenencia->unidad->datosAseguradora->n_poliza ?? 'Sin asignación',
            'gps' => $tenencia->unidad->datosAseguradora->nombre_gps ?? 'Sin asignación',
            'aseguradora' =>
                $tenencia->unidad->datosAseguradora->aseguradora->nombre_aseguradora ?? 'Sin asignación',
        ])

        <div class="card shadow-md mt-2 border-0 p-2">
            <div class="card-body">
                <form action="">
                    <div class="card-body">
                        <form action="">
                            <div class="row">
                                <div class="col-md-4 mt-4">
                                    <div class="form-group">
                                        <label for="datepicker"><b>Fecha de pago</b><span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="" class="form-control datepicker"
                                            placeholder="dd/mm/aaaa" value="{{ $tenencia->fecha_pago }}" disabled>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-4">
                                    <div class="form-group">
                                        <label for="cantidad"><b>Monto con IVA</b><span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text" style="background: #999998;"><i
                                                    class="bi bi-currency-dollar" style="color:white;"></i></span>
                                            <input type="text" class="form-control cantidad" id="cantidad"
                                                placeholder="Ingrese la cantidad" aria-label="Monto con IVA"
                                                aria-describedby="basic-addon" value="{{ $tenencia->monto_tenencia }}"
                                                disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mt-4">
                                    <div class="form-group">
                                        <label for="evidencia"><b>Evidencia</b><span class="text-danger">*</span></label><br>
                                        <div class="input-group">
                                            @if (isset($tenencia->a_evidencia_tenencia))
                                                <a href="{{ url('storage/' . $tenencia->a_evidencia_tenencia) }}" target="__blank"
                                                    class="input-download-link">
                                                    <span class="input-group-text icono-download"><i
                                                            class="bi bi-download"></i></span>
                                                </a>
                                            @endif
                                            <input type="file" class="input-archivo-down"
                                                id="archivo-input-down{{ $tenencia->id_tenencia }}"
                                                data-id="{{ $tenencia->id_tenencia }}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mt-4">
                                <div class="form-group">
                                    <label for=""><b>Observaciones</b></label>
                                    <textarea class="form-control" rows="3" disabled>{{ $tenencia->observacion }}</textarea>
                                </div>
                            </div>
                    </div>

                    <div class="d-flex justify-content-center gap-4 mt-4">
                        @include('components.btn-regresar', ['link' => 'tenencias.index'])
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
