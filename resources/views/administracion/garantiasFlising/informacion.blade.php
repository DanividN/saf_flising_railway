@extends('layouts.app')



@section('configuracion','active')
    @section('breadcrumb')
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Administración</small></a></span></li>
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="{{ route('garantias_flising.index') }}" class="rutas"><small>Garantias Flising</small></a></span></li>
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Información</small></a></span></li>

    @endsection

@section('content')
<style>
    .select2-container {
        width: 100% !important;
    }
</style>

    @include('components.alertas')
    <div class="container-fluid mt-5">

        <div class="titulo-responsive">
            <label><a>Información de Unidad</a></label>
        </div>

        @include('components.administracion.detalleUnidad', [
            'cliente' => $garantias_flising->UltimoArrendamiento->Cliente->nombre_cliente, 
            'vehiculo' => $garantias_flising->tipo_unidad->descripcion,
            'tipo_poliza' => $garantias_flising->datosAseguradora->polizas->nombre_poliza??'Sin asignación',
            'responsable_activo' => $garantias_flising->UltimoArrendamiento->Responsable->nombre_responsable,
            'marca' => $garantias_flising->marca->descripcion,
            'no_poliza' => $garantias_flising->datosAseguradora->n_poliza??'Sin asignación',
            'cargo' => $garantias_flising->UltimoArrendamiento->Responsable->cargo,
            'placas' => $garantias_flising->UltimoArrendamiento->placas,
            'gps' => $garantias_flising->datosAseguradora->gps->nombre_gps??'Sin asignación',
            'telefono' => $garantias_flising->UltimoArrendamiento->Responsable->telefono_responsable,
            'motor' => $garantias_flising->n_motor,
            'idUnidad' => $garantias_flising->vehiculo_id,
            'aseguradora' => $garantias_flising->datosAseguradora->aseguradora->nombre_aseguradora??'Sin asignación',
        ])



        <div class="card shadow-md mt-4 border-0 p-2">

            {{-- ---------------------------------------BOTONES------------------------------------------------------------------------------------- --}}
            <div class="d-flex justify-content-end" style="margin-right: .5cm; margin-top:0.8cm;">
                <button class="btn btn-primary boton-principal-corto" id="btn-pantcomp" role="button" data-bs-toggle="modal"
                    data-bs-target="#modal-asignar-garantias_id">
                    <strong>Editar Garantías</strong>
                </button>


                <button class="btn btn-respvagregar" id="btn-responsive" role="button" data-bs-toggle="modal"
                    data-bs-target="#modal-asignar-garantias_id">
                    <i class="fas fa-edit"></i>
                </button>

            </div>
            {{-- ---------------------------------------------------------------------------------------------------------------------------------------- --}}

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" class="text-start encabezado">No.</th>
                                <th scope="col" class="encabezado">Garantia extendida</th>
                                <th scope="col" class="encabezado">Vigencia</th>
                                <th scope="col" class="encabezado">Monto</th>
                                <th scope="col" class="encabezado">Fecha Inicial</th>
                                <th scope="col" class="encabezado">Fecha Final</th>
                                <th scope="col" class="encabezado">Estatus</th>
                                <th scope="col" class="encabezado">Eventos</th>
                                <th scope="col" class="encabezado">Garantía</th>
                                <th scope="col" class="encabezado">Evidencia</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($garantiasSeleccionadas as $garantiaSelect)
                                <tr class="text-center">
                                    <td class="text-start">{{ $e++ }}</td>
                                    <td>{{ $garantiaSelect->garantiasFlising->nombre_g_extendida }}</td>
                                    <td>{{ $garantiaSelect->garantiasFlising->vigencia_g_extendida }} Meses</td>
                                    <td>$
                                        {{ number_format($garantiaSelect->garantiasFlising->monto_g_extendida, 2, '.', ',') }}
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($garantiaSelect->fecha_inicial)->format('d/m/Y') }}</td>

                                    <td>{{ \Carbon\Carbon::parse($garantiaSelect->fecha_final)->format('d/m/Y') }}</td>
                                    @php
                                          $fechaFinal = \Carbon\Carbon::parse($garantiaSelect->fecha_final)->startOfDay();
                                          $fechaActual = \Carbon\Carbon::now()->startOfDay();
                                    @endphp
                                    <td>
                                        @if ($fechaActual->gt($fechaFinal) || $garantiaSelect->status == 0)
                                            Vencida
                                        @else
                                            Vigente
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            {{ $garantiaSelect->evento_asignado ?? 0 }}/{{ $garantiaSelect->garantiasFlising->eventos_por_year }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="garantia" data-id="{{ $garantiaSelect->id_garantia_proveedor }}">
                                            @if ($garantiaSelect->evento_asignado > 0)
                                                Aplicada
                                            @else
                                                No aplicada
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if ($garantiaSelect->garantiasFlising->a_evidencia_extendida)
                                            <a href="{{ asset('storage/' . $garantiaSelect->garantiasFlising->a_evidencia_extendida) }}"
                                                target="_blank">
                                                <img src="{{ asset('img/configuracion/pdf.png') }}" alt="icono.pdf"
                                                    width="23px">
                                            </a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL --}}
    @include('administracion.garantiasFlising.garantiasFlisingModal.editModalGarantiasFlising', [
        'garantiasDisponibles' => $garantiasDisponibles,
        'e' => 1,
        'garantiasSeleccionadas' => $garantiasSeleccionadas,
        'unidades' => $unidades,
    ])
    <script src="{{ asset('js/garantias/administracion/editModal.js') }}"></script>
    {{-- .......................................................... --}}
@endsection
