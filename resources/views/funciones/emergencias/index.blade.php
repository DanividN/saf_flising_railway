@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2-bootstrap-5-theme.min.css') }}">
@endsection

@section('scripts')
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC46w9k4JVOj_KdMHgVYtUvnqnmz2R-sog&libraries=places&loading=async&callback=initMap" type="text/javascript"></script>
    <script defer src="{{ asset('assets/plugins/select2-4.1/js/select2.min.js') }}"></script>
    <script defer src="{{ asset('js/select2.js') }}"></script>
@endsection

@section('funciones', 'active')
@section('breadcrumb')
        <!-- Apartado para poner las rutas o breadcrumb -->
        <li class="breadcrumb-item" aria-current="page"><span class="rutas"><small>Funciones</small></span></li>
        <li class="breadcrumb-item active" aria-current="page"><span class="rutas"><small>Emergencias</small></span></li>
@endsection


@section('content')
    @include('components.alertas')
    <div class="container-fluid mt-5">
        <div class="titulo-responsive">
            <label><a>Emergencias</a></label>
        </div>
        <div class="card shadow-md border-gray-100 border-0 p-2">
{{--BOTONES --}}
        <div class="d-flex justify-content-end" style="margin-right: .5cm; margin-top:.8cm;">
        <button type="button"
        id="btn-pantcomp"
        class="btn boton-principal-corto"
        data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fas fa-plus"></i> Emergencia
        </button>

        <button type="button"
        id="btn-responsive"
        class="btn boton-principal-corto"
        data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fas fa-plus"></i>
        </button>
{{------------}}

        </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" class="text-start encabezado">No.</th>
                                <th scope="col" class="encabezado">Vehiculo</th>
                                <th scope="col" class="encabezado">Placas</th>
                                <th scope="col" class="encabezado">Cliente</th>
                                <th scope="col" class="encabezado">Aseguradora</th>
                                <th scope="col" class="encabezado">Responsable</th>
                                <th scope="col" class="encabezado">Emergencia</th>
                                <th scope="col" class="encabezado">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($emergencias as $emergencia)
                                <tr class="text-center">
                                    <td class="text-start">{{++$i}}</td>
                                    <td>{{$emergencia->modelo}}</td>
                                    <td>{{$emergencia->placas}}</td>
                                    <td>{{$emergencia->nombre_cliente}}</td>
                                    <td>{{$emergencia->nombre_aseguradora}}</td>
                                    <td>{{$emergencia->nombre_responsable}}</td>
                                    <td>
                                        @if ($emergencia->estado_emergencia === 1)
                                            <span style="display: inline-flex; align-items: center;">
                                                <span class="badge bg-yellow-status" style="height: 10px; width: 10px; border-radius: 50%; display: inline-block;"></span>
                                                <span class="text-yellow-status" style="margin-left: 5px;">En proceso</span>
                                            </span>
                                        @elseif($emergencia->estado_emergencia === 2)
                                            <span style="display: inline-flex; align-items: center;">
                                                <span class="badge bg-green-status" style="height: 10px; width: 10px; border-radius: 50%; display: inline-block;"></span>
                                                <span class="text-green-status" style="margin-left: 5px;">Concluido</span>
                                            </span>
                                        @else
                                            <span style="display: inline-flex; align-items: center;">
                                                <span class="badge bg-red-status" style="height: 10px; width: 10px; border-radius: 50%; display: inline-block;"></span>
                                                <span class="text-red-status" style="margin-left: 5px;">Cancelado</span>
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle dropdown-toggle-no-caret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}" alt="menu" style="width: 30px !important;">
                                            </a>

                                            <ul class="dropdown-menu p-0">
                                                <li><a class="dropdown-item" href="{{ route('emergenciasCall.info', $emergencia->id_asignacion_unidad ) }}">Información</a></li>
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
    @include('funciones.emergencias.agregarEmergencia')
    <script>
        function cambio() {
            let id_cliente = document.getElementById('idCliente').value;
            fetch('clientes/' + id_cliente)
                .then(response => response.json())
                .then(data => {
                    let unidadesSelect = document.getElementById('unidad');
                    unidadesSelect.innerHTML = ''; // Limpiar las opciones actuales

                    // Agregar opción predeterminada "Seleccionar"
                    let defaultOption = document.createElement('option');
                    defaultOption.disabled = true; // No seleccionable
                    defaultOption.selected = true; // Se muestra como seleccionada al inicio
                    unidadesSelect.appendChild(defaultOption);

                    if (data.length === 0) {
                        // No hay registros, mostrar mensaje
                        let noUnitsOption = document.createElement('option');
                        noUnitsOption.textContent = 'No se encontraron unidades';
                        noUnitsOption.disabled = true;
                        unidadesSelect.appendChild(noUnitsOption);
                    } else {
                        // Hay registros, agregarlos al select
                        data.forEach(unidad => {
                            let option = document.createElement('option');
                            option.textContent = 'Seleccionar';
                            option.value = unidad.id_asignacion_unidad;
                            option.textContent = unidad.placas;
                            unidadesSelect.appendChild(option);
                        });
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function cambioUnidad() {
            let id_unidad = document.getElementById('unidad').value;
            fetch('responsable/' + id_unidad)
                .then(response => response.json())
                .then(data => {
                    let responsableUnidad = document.getElementById('id_responsable');
                    if (data.length > 0) {
                        responsableUnidad.value = data[0].id_responsable; // Mostrar el primer id_responsable
                    } else {
                        responsableUnidad.value = ''; // Si no hay datos, limpiar el campo
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
@endsection
