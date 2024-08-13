<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title title-orange" id="staticBackdropLabel">Agregar emergencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="" action=" {{ route('emergenciasCall.store') }} " class="needs-validation" novalidate method="post">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid mt-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label><h5>Cliente</h5></label>
                                <select id="idCliente" class="form-select single-select-field" placeholder="Clientes" onchange="cambio()" name="id_cliente" required>
                                    <option value="" hidden>Seleccionar Cliente</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{$cliente->id_cliente}}">{{$cliente->nombre_cliente}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label><h5>Placas</h5></label>
                                <select class="menu single-select-field" type="text" placeholder="Unidades" id="unidad" name="id_asignacion_unidad" onchange="cambioUnidad()" required>
                                    <option value="" hidden>Seleccionar Placas</option>
                                </select>
                            </div>
                            <input type="text" name="id_responsable" id="id_responsable" value="" hidden>
                            <input type="text" name="estado_emergencia" id="id_responsable" value="1" hidden>
                            <div class="col-md-3">
                                <label><h5>Emergencias</h5></label>
                                <select class="form-select" type="text" placeholder="Emergencias" name="id_tipo_emergencia" required>
                                    <option value="" hidden>Seleccionar:</option>
                                    @foreach ($tipos_emergencias as $emergencia)
                                        <option value="{{$emergencia->id_tipo_emergencia}}">{{$emergencia->descripcion}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <label for="exampleFormControlTextarea1" class="form-label"><h5>Descripción</h5></label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="descripcion_emergencia" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 d-flex justify-content-center">
                    <button type="submit" class="btn btn-enviar rounded-lg d-flex">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



