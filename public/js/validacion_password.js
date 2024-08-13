const password = document.getElementById('password');
const alertPassword = document.getElementById('alert-password');
const passwordConfirmation = document.getElementById('password-confirmation');
const alertPasswordConfirmation = document.getElementById('alert-password-confirmation');

const showPassword = document.getElementById('show-password');
const showPasswordConfirm = document.getElementById('show-password-confirmation');
const btnSubmit = document.getElementById('btn-reset-password');

const loadFunctions = () => {
    $('#passwordResetModal').modal('show');
    
    //Ocultar y motrar contenido de las contraseñas
    togglePasswordVisibility('show-password', 'password');
    togglePasswordVisibility('show-password-confirmation', 'password-confirmation');

    //evitar que los usuarios copien y peguen contraseñas
    password.addEventListener('copy', (e) => e.preventDefault());
    password.addEventListener('paste', (e) => e.preventDefault());
    password.addEventListener('cut', (e) => e.preventDefault());

    passwordConfirmation.addEventListener('copy', (e) => e.preventDefault());
    passwordConfirmation.addEventListener('paste', (e) => e.preventDefault());
    passwordConfirmation.addEventListener('cut', (e) => e.preventDefault());

    //validacion de  las contraseñas
    password.addEventListener('input', validatePassword);
    passwordConfirmation.addEventListener('input', validatePasswordConfirmation);

    //deshabilitar boton de submit
    disabledSubmitButton();
}

const togglePasswordVisibility = (toggleButtonId, passwordFieldId) => {
    const toggleButton = document.getElementById(toggleButtonId);
    const passwordField = document.getElementById(passwordFieldId);

    toggleButton.addEventListener('click', () => {
        passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
    });
};

function validatePassword() {
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).{8,}$/;

    if (!passwordRegex.test(password.value)) {
        alertPassword.hidden = false;
        alertPassword.innerHTML = 'La contraseña no coincide con los requisitos mínimos de seguridad.';
    } else {
        alertPassword.hidden = true;
    }
    validatePasswordConfirmation();
    disabledSubmitButton();
}

function validatePasswordConfirmation() {
    if (password.value !== passwordConfirmation.value) {
        alertPasswordConfirmation.hidden = false;
        alertPasswordConfirmation.innerHTML = 'Las contraseñas no coinciden.';
    } else {
        alertPasswordConfirmation.hidden = true;
    }
    disabledSubmitButton();
}

function disabledSubmitButton() {
    if (alertPassword.hidden && alertPasswordConfirmation.hidden && password.value !== '' && passwordConfirmation.value !== '') {
        btnSubmit.disabled = false;
    } else {
        btnSubmit.disabled = true;
    }

}

document.addEventListener('DOMContentLoaded', loadFunctions);
