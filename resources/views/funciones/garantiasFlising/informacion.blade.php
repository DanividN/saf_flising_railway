@extends('layouts.app')

@section('configuracion','active')
    @section('breadcrumb')
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Funciones</small></a></span></li>
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="{{ route('garantias_callCenter.index') }}" class="rutas"><small>Garantias Flising</small></a></span></li>
    <li class="breadcrumb-item" aria-current="page"><span class="rutas"><a href="" class="rutas"><small>Información</small></a></span></li>

    @endsection

@section('content')
    @include('components.alertas')
    <div class="container-fluid mt-5">
        <div class="titulo-responsive">
            <label><a>Información de Unidad</a></label>
        </div>
        @include('components.administracion.detalleUnidad', [
            'cliente' => $garantia->UltimoArrendamiento->Cliente->nombre_cliente,
            'vehiculo' => $garantia->tipo_unidad->descripcion,
            'tipo_poliza' => $garantia->datosAseguradora->polizas->nombre_poliza??'Sin asignación',
            'responsable_activo' => $garantia->UltimoArrendamiento->Responsable->nombre_responsable,
            'marca' => $garantia->marca->descripcion,
            'no_poliza' => $garantia->datosAseguradora->n_poliza??'Sin asignación',
            'cargo' => $garantia->UltimoArrendamiento->Responsable->cargo,
            'placas' => $garantia->UltimoArrendamiento->placas,
            'gps' => $garantia->datosAseguradora->gps->nombre_gps??'Sin asignación',
            'telefono' => $garantia->UltimoArrendamiento->Responsable->telefono_responsable,
            'motor' => $garantia->n_motor,
            'idUnidad' => $garantia->vehiculo_id,
            'aseguradora' =>  $garantia->datosAseguradora->aseguradora->nombre_aseguradora??'Sin asignación',
        ])



        <div class="card shadow-md mt-2 border-0 p-2">

            {{-- -------------------------------------------------Boton------------------------------------------------------------------ --}}
            <div class="d-flex justify-content-end align-items-center" style="margin-right: .4cm; margin-top:0.8cm;">
                {{-- -------------------------------------- --}}
                <a href="#" class="btn btn-informe-orange boton-telefono me-2" id="btn-phonepantallacomp"
                    data-bs-toggle="modal" data-bs-target="#miRegistroModal">
                    &nbsp; &nbsp; &nbsp; Mi registro
                </a>

                <a href="#" class="btn btn-informe-orange boton-telefono me-2" id="btn-phonepantrespons"
                    data-bs-toggle="modal" data-bs-target="#miRegistroModal">
                </a>
            </div>
            {{-- ------------------------------------------------------------------------------------------------------------------------------- --}}
            {{-- modal --}}
            <div class="modal fade" id="miRegistroModal" tabindex="-1" aria-labelledby="miRegistroModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <!-- Cambia a modal-lg o modal-xl -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="miRegistroModalLabel" style="color:#ED5429;">Registro de
                                Atención
                            </h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('altaRegistroAtencion') }}" method="POST" id="registroForm"
                            onsubmit="validateForm(this)" class="needs-validation" novalidate>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    @csrf
                                    <input type="hidden" name="id_asignacion_unidad"
                                        value="{{ $garantia->UltimoArrendamiento->id_asignacion_unidad }}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong class="info-item">Cliente:
                                                {{ $garantia->UltimoArrendamiento->Cliente->nombre_cliente }}</strong><br />
                                            <strong class="info-item">Responsable de Activo:
                                                {{ $garantia->UltimoArrendamiento->Responsable->nombre_responsable }}</strong><br />
                                            <strong class="info-item">Cargo:
                                                {{ $garantia->UltimoArrendamiento->Responsable->cargo }}</strong><br />
                                            <strong class="info-item">Teléfono:
                                                {{ $garantia->UltimoArrendamiento->Responsable->telefono_responsable }}</strong>
                                        </div>
                                        <div class="col-md-6">
                                            <strong class="info-item">ID. Unidad:
                                                {{ $garantia->vehiculo_id }}</strong><br />
                                            <strong class="info-item">Marca:
                                                {{ $garantia->marca->descripcion }}</strong><br />
                                            <strong class="info-item">Placas:
                                                {{ $garantia->UltimoArrendamiento->placas }}</strong>
                                        </div>
                                    </div>
                                    <hr style="color: #929292dd">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label" for="">Estatus de Llamada:</label>
                                            <input class="form-check-input required" type="radio" name="estatus"
                                                id="estatus1" value="Atendido" required>
                                            <label class="form-check-label" for="estatus"> Atendido </label>
                                            <input class="form-check-input" type="radio" name="estatus" id="estatus2"
                                                value="No atendido" required>
                                            <label class="form-check-label" for="estatus"> No atendido </label>

                                            <div class="invalid-feedback">
                                                El estatus de llamada es invalido
                                            </div>
                                        </div>


                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Fecha:</label>
                                            <input class="form-control datepicker" type="text" placeholder="mm/dd/aaaa"
                                                name="fecha" value="{{ $fechaActual }}" disabled>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Hora:</label>
                                            <input class="form-control" type="text" placeholder="00:00" name="hora"
                                                value="{{ $horaActual }}" disabled>

                                        </div>
                                        <div class="col-md-4">
                                            <label>Usuario:</label>
                                            <input class="form-control" type="text" placeholder="Usuario"
                                                value="{{ Auth::user()->name }}" disabled>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 my-4">
                                            <label>Descripción:</label>
                                            <textarea class="form-control" rows="3" placeholder="Ingrese aquí sus observaciones" name="descripcion" required></textarea>
                                            <div class="invalid-feedback">
                                                La descripción es requerida
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-center">
                                {{-- <button type="button" class="btn btn-principal-corto btn-flis-corto" data-bs-dismiss="modal">Cerrar</button> --}}
                                <button type="submit" class="btn btn-orange btn-flis-corto"
                                    id="guardarBtn">Guardar</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            {{-- ------- --}}
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
                                <th scope="col" class="encabezado">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($garantiasSeleccionadas as $garantiaSelect)
                            {{-- @dd($garantiaSelect) --}}
                            <tr class="text-center">
                                    <td class="text-start">{{ $loop->iteration }}</td>
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
                                        
                                        @if ($fechaActual->gt($fechaFinal) /* || $garantiaSelect->status == 0 */ )
                                            Vencida
                                        @elseif($garantiaSelect->status == 0 )
                                            Cancelada
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
                                            <a 
                                                href="{{ asset('storage/' . $garantiaSelect->garantiasFlising->a_evidencia_extendida) }}"
                                                target="_blank">
                                                <img src="{{ asset('img/configuracion/pdf.png') }}" alt="icono.pdf"
                                                    width="23px">
                                            </a>
                                        @endif

                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="dropdown-toggle dropdown-toggle-no-caret" href="#"
                                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="{{ asset('img/administracion/autirizacionesMantenimiento/list.png') }}"
                                                    alt="menu" style="width: 30px !important;">
                                            </a>

                                            <ul class="dropdown-menu p-0">
                                                <li>
                                                    @if ($fechaActual->gt($fechaFinal) || $garantiaSelect->status == 0 )
                                                        <div class="dropdown-item" style="cursor: not-allowed;">
                                                            No Aplica
                                                        </div>
                                                    @else
                                                        <form action="{{ route('garantias_callCenter.store') }}"
                                                            method="POST">
                                                            
                                                            @csrf
                                                            <input type="hidden" name="id_unidad_garantia"
                                                                value="{{ $garantiaSelect->id_unidad_garantia }}">
                                                            <input type="hidden" name="id_unidad"
                                                                value="{{ $garantiaSelect->id_unidad }}">
                                                            <input type="hidden" name="id_proveedor"
                                                                value="{{ $garantiaSelect->id_garantia_proveedor }}">
                                                            <input type="hidden" name="id_asignacion_unidad"
                                                                value="{{ $garantiaSelect->id_asignacion_unidad }}">
                                                            <input type="hidden" name="siguiente_evento"
                                                                value="{{ $garantiaSelect->evento_asignado }}">
                                                            <input type="hidden" name="evento_inical"
                                                                value="{{ $garantiaSelect->garantiasFlising->eventos_por_year }}">
                                                            <input class="dropdown-item" type="submit"
                                                                value="Aplicar Garantía">
                                                        </form>
                                                    @endif

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
    <script>
        // function bloqueoBoton(e) {
        //     const formValues = {};
        //     for (let [key, value] of new FormData(e).entries()) formValues[key] = value;
        //     if (Object.values(formValues).some((x) => x == "")) {
        //         Swal.fire({
        //             icon: 'error',
        //             title: 'Error',
        //             text: 'El estatus de llamada es requerido',
        //         });
        //         return;
        //     };
           
        // }

        function validateForm(e) {
            if (!e.checkValidity()){
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Valida tus campos",
                });
            }else{
                const submitButton = document.getElementById('guardarBtn');
                submitButton.disabled = true;
                submitButton.textContent = 'Guardando...';
            }
          
        }
    </script>
@endsection
