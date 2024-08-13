<div class="modal fade @if ($errors->any()) show @endif" id="responsableModal" tabindex="-1"aria-labelledby="responsableModalLabel" aria-hidden="true" @if ($errors->any()) style="display:block;" @endif data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 m-0">
                <h5 class="modal-title" id="responsableModalLabel" style="color:#ED5429;">Estatus de unidad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="{{ route('unidades.estatus', ['unidade' => 0]) }}" method="POST"
                        class="needs-validation" id="formulario" novalidate enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Para el método PUT en la actualización -->
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="id_estado" class="form-label"><b>Estatus</b></label>
                                        <select class="form-select" name="id_estado" id="id_estado" required>
                                            <option value="" hidden>Tipo de vehículo</option>
                                            @foreach ($estado as $tp)
                                                <option value="{{ $tp->id_estado }}"
                                                    {{ old('id_estado') == $tp->id_estado ? 'selected' : '' }}>
                                                    {{ $tp->nombre_estado }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('id_estado')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button type="submit" id="save_responsable" class="btn add_agencia">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Script para manejar el ID de la unidad -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const responsableModal = document.getElementById('responsableModal');
        responsableModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const unidadId = button.getAttribute('data-id');
            const form = responsableModal.querySelector('form');
            form.action = form.action.replace('0', unidadId);
        });
    });
</script>
