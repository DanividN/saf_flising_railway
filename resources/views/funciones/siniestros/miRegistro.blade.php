    <div class="modal fade" id="miRegistroModal" tabindex="-1" aria-labelledby="miRegistroModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="miRegistroModalLabel" style="color:#ED5429;">Registro de
                        Atención
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-6">
                                <strong class="info-item">Cliente:{{ $registro->cliente->nombre_cliente ?? 'Sin asignación'}}</strong><br />
                                <strong class="info-item">Responsable de Activo: {{ $registro->cliente->responsable->nombre_responsable ?? 'Sin asignación' }}</strong><br />
                                <strong class="info-item">Cargo: {{ $registro->cliente->responsable->cargo ?? 'Sin asignación'}}</strong><br />
                                <strong class="info-item">Teléfono: {{ $registro->cliente->responsable->telefono_responsable ?? 'Sin asignación'}}</strong>
                            </div>
                            <div class="col-md-6">
                                <strong class="info-item">ID. Unidad:{{$registro->unidad->vehiculo_id ?? 'Sin asignación'}}</strong><br />
                                <strong class="info-item">Marca: {{$registro->unidad->marca->descripcion ?? 'Sin asignación'}}</strong><br />
                                <strong class="info-item">Placas: {{$registro->unidad->UltimoArrendamiento->placas ?? 'Sin asignación'}}</strong>
                            </div>
                        </div>

                        <hr style="color: #929292dd">
                        <form action="{{ route('siniestro.registro') }}" method="post" enctype="multipart/form-data"
                            class="needs-validation" id="formulario" novalidate onsubmit="return bloqueoBoton(event)">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Estatus de Llamada</h5>
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault1" value="Atendido" required>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Atendido
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault1" value="No atendido">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            No atendido
                                            <div class="invalid-feedback"style="margin:10px 0px;">
                                                <p class="text-danger">El estatus de llamada no es valido</p>
                                            </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <input type="text" hidden name="id_unidad" value="{{$unidad->UltimoArrendamiento->id_asignacion_unidad}}">
                                <div class="col-md-4">
                                    <label>Fecha:</label>
                                    <input class="form-control datepicker" type="text" placeholder="mm/dd/aaaa" value="{{ $dia_actual }}" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label>Hora:</label>
                                    <input class="form-control" type="time" placeholder="00:00:00" value="{{ $hora_actual }}" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label>Usuario:</label>
                                    <input class="form-control" type="text" placeholder="Usuario" value="{{Auth::user()->name}}" disabled>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label>Observaciones:</label>
                                    <textarea class="form-control" name="descripcion" rows="3" placeholder="Ingrese aquí sus observaciones" required></textarea>
                                    <div class="invalid-feedback"style="margin:10px 0px;">
                                        <p class="text-danger">La observación no es valido</p>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-orange btn-flis-corto">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
        <button class="btn btn-respvagregar" id="btn-agregarResponsive" data-bs-toggle="modal"
            data-bs-target="#supervisionModal" style="margin-right: .4cm;">
            <i class="fas fa-plus"></i>
        </button>
    </div>
    <script src="{{ asset('js/botonBloqueo.js') }}"></script>
