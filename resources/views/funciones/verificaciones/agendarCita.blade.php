
@section('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-4.1/css/select2-bootstrap-5-theme.min.css') }}">
@endsection
@section('scripts')
<script defer src="{{ asset('assets/plugins/select2-4.1/js/select2.min.js') }}"></script>
<script defer src="{{ asset('js/select2.js') }}"></script>
@endsection

<div class="modal fade" id="agendarCita" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modal-asignar-garantias" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 m-0">
                <h5 class="modal-title title-orange" id="staticBackdropLabel">Agendar verificación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id='FormAgendarCita' action="{{ route('verificacion.agendar', $unidad->id_unidad ?? 0) }}" method='POST'
                class="needs-validation" enctype="multipart/form-data" onsubmit='blockBtn(this)' novalidate>
                @csrf
                <div class="modal-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="id_entidad_federativa"><b>Entidad federativa</b><span
                                        class="text-danger">*</span></label>
                                <select class="menu single-select-field" id="id_entidad_federativa" name='id_entidad_federativa'
                                    onchange="searchMunicipios(this.value)" required>
                                    <option value="" disabled selected hidden>Seleccionar</option>
                                    @foreach ($entidades as $e)
                                        <option value="{{ $e->id_entidad_federativa }}">
                                            {{ $e->nombre_entidad_federativa }}</option>
                                    @endforeach
                                </select>
                                @error('id_entidad_federativa')
                                    <div class='text-danger my-2'>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="invalid-feedback text-danger my-2">
                                    La entidad federativa es invalida
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="id_municipio"><b>Municipio/Alcaldía</b><span
                                        class="text-danger">*</span></label>
                                <select class="menu single-select-field" id="id_municipio" name='id_municipio'
                                    onchange="searchVerificentros(this.value)" required>
                                    <option value="" disabled selected hidden>Seleccionar</option>
                                </select>
                                @error('id_municipio')
                                    <div class='text-danger my-2'>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="invalid-feedback text-danger my-2">
                                    La Municipio/Alcaldía es invalida
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-4">
                            <div class="form-group">
                                <label for="id_verificentro"><b>Verificentro</b><span
                                        class="text-danger">*</span></label>
                                <select class="menu single-select-field" id="id_verificentro" name='id_verificentro'
                                    onchange="setDireccion(this.value)" required>
                                    <option value="" disabled selected hidden>Seleccionar</option>
                                </select>
                                @error('id_verificentro')
                                    <div class='text-danger my-2'>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="invalid-feedback text-danger my-2">
                                    El verificentro es invalido
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-4">
                            <div class="form-group">
                                <label for="cliente"><b>Dirección</b><span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="direccion"
                                    value="Dirección del verificentro" disabled>
                            </div>
                        </div>

                        <div class="col-md-6 mt-4">
                            <div class="form-group">
                                <label for="fecha"><b>Fecha</b><span class="text-danger">*</span></label>
                                <input class="datepicker form-control" name='fecha' placeholder="dd/mm/aaaa"
                                    required>
                                @error('fecha')
                                    <div class='text-danger my-2'>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="invalid-feedback text-danger my-2">
                                    La fecha es invalida
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mt-4">
                            <div class="form-group">
                                <label for="hora"><b>Hora</b><span class="text-danger">*</span></label>
                                <input type="time" class="form-control" name='hora' required>
                                @error('hora')
                                    <div class='text-danger my-2'>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="invalid-feedback text-danger my-2">
                                    La hora es invalida
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-4">
                            <div class="form-group">
                                <label for="a_cita"><b>Adjuntar Cita</b><span class="text-danger">*</span></label><br>
                                <input type="file" accept=".pdf" class="input-archivo" name='a_cita'
                                    id="archivo-input" required>
                                @error('a_cita')
                                    <div class='text-danger my-2'>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="invalid-feedback text-danger my-2">
                                    La cita es invalida
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer border-0 d-flex justify-content-center">
                    <button id='AgendarBtn' type="submit" class="btn btn-enviar rounded-lg d-flex">Agendar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src='{{ asset('js/input-file.js') }}'></script>
<script>
    const rute = '{{ $unidad->id_unidad ?? 0 }}';
</script>
<script src='{{ asset('js/verificacion/modal.js') }}'></script>
