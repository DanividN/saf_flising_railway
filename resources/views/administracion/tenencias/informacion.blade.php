@extends('layouts.app')
@section('admi','active')
@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Administración</small></a></span></li>
<li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="{{route('unidadTenencia.index')}}" class="rutas"><small>Tenencias</small></a></span></li>
<li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="{{route('unidadTenencia.index')}}" class="rutas"><small>Información</small></a></span></li>
@endsection
@section('content')
    @include('components.alertas')
    <div class="container-fluid mt-5">
        <div class="titulo-responsive">
            <label><a>Información</a></label>
        </div>
        <div class="card shadow-md border-gray-100 border-0 p-2">
            {{-- -----------------------------BOTONES---------------------------------------------------------------------- --}}
            <div class="d-flex justify-content-end align-items-center" style="margin-right: .5cm; margin-top: 1cm;">
                <a href="{{ route('tenencias.excel', $unidad) }}" class="btn btn-informe-orange me-1 boton-descargarInforme"
                    id="btn-infor-pantcomplet">
                    &nbsp; &nbsp; &nbsp; Descargar informe
                </a>
                <a href="" class="btn btn-informe-orange me-2 boton-descargarInforme" id="btn-infor-responsive"
                    style="width: 45px; height: 45px">
                </a>
                {{-- ---------------------------------------------------------- --}}
                @if (!$unidad->tieneTenenciaActual())
                    @include('components.btn-agregar', [
                        'link' => 'tenencias.create',
                        'name' => 'Agregar tenencia',
                        'id' => 'btn-pantcomp',
                    ])
                    {{-- ---------------------------------------------------------- --}}
                    <a href="{{ URL('tenencias/agregar') }}" type="button" class="btn btn-respvagregar"
                        id="btn-agregarResponsive">
                        <i class="fas fa-plus"></i>
                    </a>
                @endif
            </div>
            {{-- ----------------------------------------------------------------------------------------------------------------------- --}}
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" class="text-start encabezado">No.</th>
                                <th scope="col" class="encabezado">Placas</th>
                                <th scope="col" class="encabezado">Marca</th>
                                <th scope="col" class="encabezado">Fecha de pago</th>
                                <th scope="col" class="encabezado">Monto con IVA</th>
                                <th scope="col" class="encabezado">Cliente</th>
                                <th scope="col" class="encabezado">Evidecia</th>
                                <th scope="col" class="encabezado">Estatus</th>
                                <th scope="col" class="encabezado">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tenencias as $tenencia)
                                <tr class="text-center">
                                    <td class="text-start">{{ $loop->iteration }}</td>
                                    <td>{{ $tenencia->arrendaminto->placas ?? 'Sin asignación' }}</td>
                                    <td>{{ $tenencia->unidad->marca->descripcion }}</td>
                                    <td>{{ $tenencia->fecha_pago }}</td>
                                    <td>${{ number_format(floatval($tenencia->monto_tenencia), 2) }}</td>


                                    <td>{{ $tenencia->arrendaminto->Cliente->nombre_cliente ?? 'Sin asignación' }}</td>
                                    <td>
                                        @if ($tenencia->a_evidencia_tenencia)
                                            <a href="{{ url('storage/' . $tenencia->a_evidencia_tenencia) }}"
                                                class="boton-pdf" target="__blank">
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <span style="display: inline-flex; align-items: center;">
                                            <span class="badge bg-green-status status"
                                                style="border-radius: 50%; display: inline-block;"></span>
                                            <span class="text-green-status" style="margin-left: 5px;">Pagado</span>
                                        </span>
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
                                                        href="{{ route('tenencias.show', $tenencia) }}">Ver</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- ---- --}}
        </div>
    </div>

    @include('administracion.garantiasFlising.modalAsignarGarantias')
@endsection
