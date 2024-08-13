<div class="modal fade" id="siniestroModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-asignar-garantias" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 m-0">
                <h5 class="modal-title title-orange" id="staticBackdropLabel">Agregar siniestros</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('asignacionSiniestro.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" id="formulario" novalidate onsubmit="return bloqueoBoton(event)">
                @csrf
                <div class="modal-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="cliente"><b>Cliente</b><span class="text-danger">*</span></label>
                                <select class="menu form-select" name="id_cliente" style="height:35px;" id="id_cliente" required>
                                    <option value="" hidden>-- Seleccionar --</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre_cliente }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"style="margin:10px 0px;">
                                    <p class="text-danger">El cliente no es valido</p>
                                </div>
                                <div class="text-danger"style="margin:10px 0px;">
                                    @error('id_cliente')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="unidad"><b>Placas / I.D unidad</b><span class="text-danger">*</span></label>
                                <select class="menu single-select-field unidad" name="id_unidad" style="height:35px; width:100%;" id="unidad" required></select>
                                <div class="invalid-feedback"style="margin:10px 0px;">
                                    <p class="text-danger">Las placas / i.d unidad no es valido</p>
                                </div>
                                <div class="text-danger"style="margin:10px 0px;">
                                    @error('id_unidad')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 d-flex justify-content-center">
                    <button type="submit" class="btn btn-orange rounded-lg d-flex" id="guardarBtn">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    var siniestroUnidadesUrl = "{{ route('siniestro.unidades') }}";
</script>
<script src='{{ asset('js/siniestros/unidades.js') }}'></script>
<script src="{{ asset('js/botonBloqueo.js') }}"></script>
