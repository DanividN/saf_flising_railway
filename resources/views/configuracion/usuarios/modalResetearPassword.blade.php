
<div class="modal fade" id="passwordResetModal"data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0 m-0 d-block">
                <h5 class="modal-title title-orange" id="staticBackdropLabel">Cambiar contraseña</h5>
                <p>
                    La contraseña debe tener una longitud mínima de 8 caracteres y 
                    contener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial(!@#$%^&*).
                </p>
            </div>

            <form method="POST" action="{{ route('usuarios.cambiar.password', Auth::user()->id) }}" class="needs-validation" novalidate>
                <div class="modal-body m-0">
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <input type="checkbox" id="show-password" style="border: solid #000000;"> Mostrar Contraseña
                                <div class="alert alert-danger p-1" role="alert" id="alert-password" hidden></div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                                <input type="password" class="form-control" id="password-confirmation" name="password_confirmation" required>
                                <input type="checkbox" id="show-password-confirmation" style="border: solid #000000;"> Mostrar Contraseña
                                <div class="alert alert-danger p-1" role="alert" id="alert-password-confirmation" hidden></div>
                            </div>
                        </div>
                    </div>

                </div>
                
                <div class="modal-footer border-0 d-flex justify-content-center">
                    <button type="submit" class="btn btn-orange rounded-lg d-flex" data-bs-dismiss="modal" id="btn-reset-password">Cambiar contraseña</button>
                </div>
            </form>
        </div>
    </div>
</div>