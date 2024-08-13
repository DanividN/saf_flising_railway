@extends('layouts.app')
@section('configuracion','active')
@section('breadcrumb')
<li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Configuración</small></a></span></li>
<li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="{{route('unidades.index')}}" class="rutas"><small>Registro de unidades</small></a></span></li>
<li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Información de unidad</small></a></span></li>
@endsection
@section('scripts')
    <script src="{{ asset('js/datatable.js') }}"></script>
@endsection
@section('content')
    <div class="container-fluid mt-5">
        <div class="titulo-responsive">
            <label><a>Información de Unidad</a></label>
        </div>
        <div class="card shadow-md border-gray-100 border-0 p-2">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" class="encabezado">No</th>
                                <th scope="col" class="encabezado">Cliente</th>
                                <th scope="col" class="encabezado">Placas</th>
                                <th scope="col" class="encabezado">Plazo</th>
                                <th scope="col" class="encabezado">Inicio de arrendamiento</th>
                                <th scope="col" class="encabezado">Fin de arrendamiento</th>
                                <th scope="col" class="encabezado">Alta de placas</th>
                                <th scope="col" class="encabezado">Comprobante de pago</th>
                                <th scope="col" class="encabezado">Tarjeta de Circulación</th>
                                <th scope="col" class="encabezado">Situación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($unidade->arrendamientos as $arrendamiento)
                                <tr class="text-center">
                                    <td class="text-start">{{ $loop->iteration }}</td>
                                    <td>{{ $arrendamiento->Cliente->nombre_cliente }}</td>
                                    <td>{{ $arrendamiento->placas }}</td>
                                    <td>{{ $arrendamiento->Plazo->plazo }}</td>
                                    <td>{{ $arrendamiento->fecha_inicial->format('d/m/Y') }}</td>
                                    <td>{{ $arrendamiento->fecha_final->format('d/m/Y')  }}</td>
                                    <td class="text-center">
                                        @if ($arrendamiento->a_alta_placas)
                                                <a href="{{ url('storage/' . $arrendamiento->a_alta_placas) }}"
                                                    class="boton-pdf"
                                                    target="__blank">
                                                </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($arrendamiento->a_derechos_vehiculares)
                                                <a href="{{ url('storage/' . $arrendamiento->a_derechos_vehiculares) }}"
                                                    class="boton-pdf"
                                                    target="__blank">
                                                </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($arrendamiento->a_tarjeta_circulacion)
                                                <a href="{{ url('storage/' . $arrendamiento->a_tarjeta_circulacion) }}"
                                                    class="boton-pdf"
                                                    target="__blank">
                                                </a>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $arrendamiento->DetalleAsignacion->estado->nombre_estado}}
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
