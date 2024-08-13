<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title title-orange" id="staticBackdropLabel">Agregar nueva póliza</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formTracking" action="{{ route('tracking.store') }}" class="needs-validation" novalidate method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row d-flex justify-content-center">
                        <input type="text" name="id_aseguradora" value="{{ $aseguradora[0]->id_aseguradora }}" hidden>
                        <div class="col-md-6 col-sm-12">
                            <label for="nombre_poliza"><b>Nombre de póliza</b><span class="text-danger">*</span></label>
                            <input type="text" id="nombre_poliza" name="nombre_poliza" class="form-control" placeholder="Nombre de póliza" required>
                            @error('nombre_poliza')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="dano_material"><b>Porcentaje de daño material</b><span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">%</span>
                                <input type="text" id="dano_material" name="dano_material" class="form-control" placeholder="00" required>
                            </div>
                            @error('dano_material')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="robo_total"><b>Porcentaje de robo total</b><span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">%</span>
                                <input type="text" id="robo_total" name="robo_total" class="form-control" placeholder="00" required>
                            </div>
                            @error('robo_total')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="a_poliza"><b>Documento de póliza</b><span class="text-danger">*</span></label>
                            <input type="file" id="archivo-input" name="a_poliza" class="input-archivo" placeholder="Documento de póliza" required>
                            <div class="invalid-feedback">
                                Falta subir archivo
                            </div>
                            @error('a_poliza')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <label><b>Estatus</b></label>
                            <div class="input-group mb-3">
                                <label class="switch">
                                    <input type="checkbox" name="activo" id="active" value="1" checked>
                                    <span class="slider round"></span>
                                </label>
                                <input type="text" class="switch_label" id="active_label" value="Activo" readonly>
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
