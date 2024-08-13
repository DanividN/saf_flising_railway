document.addEventListener('DOMContentLoaded', function() {
    // Selecciona el formulario
    const form = document.querySelector('form.needs-validation');

    // Añade un evento de escucha al evento submit del formulario
    form.addEventListener('submit', function(event) {
        // Evita el envío del formulario si hay campos vacíos
        if (!validateForm()) {
            event.preventDefault();
            event.stopPropagation();

            // Muestra la alerta usando SweetAlert
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hay uno o varios campos vacíos. Por favor, revise nuevamente.',
                confirmButtonText: 'Ok'
            });
        }
    });

    // Función para validar el formulario
    function validateForm() {
        let isValid = true;

        // Selecciona todos los campos del formulario
        const fields = form.querySelectorAll('input[required], select[required]');

        fields.forEach(function(field) {
            if (field.value.trim() === '') {
                isValid = false;
                // Agrega la clase de invalid feedback a los campos vacíos
                field.classList.add('is-invalid');
            } else {
                field.classList.remove('is-invalid');
            }
        });

        return isValid;
    }
});

function validarRFC(e){
    var rfcValue = e.target.value.trim().toUpperCase();
    var rfcPattern = /^([A-ZÑ&]{3,4})(\d{6})([A-Z\d]{3})$/;
    if (!rfcPattern.test(rfcValue)) {
        e.target.classList.add("is-invalid");
    } else {
        e.target.classList.remove("is-invalid");
    }
    e.target.value = rfcValue;
}

function validarEmail(e) {
    var emailValue = e.target.value.trim();
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(emailValue)) {
        e.target.classList.add("is-invalid");
    } else {
        e.target.classList.remove("is-invalid");
    }
    e.target.value = emailValue;
}


const telInputs = document.querySelectorAll('.tel-input');
telInputs.forEach(input => {
    input.addEventListener('input', function(event) {
        const inputValue = event.target.value;
        const numericValue = inputValue.replace(/\D/g, '');
        const formattedValue = numericValue.replace(/(\d{3})(\d{3})(\d{4})/, '$1 $2 $3');
        input.value = formattedValue;
    });
});

const cpInput = document.querySelectorAll('.cp');
cpInput.forEach(input => {
    input.addEventListener('input', function(event) {
        const inputValue = event.target.value;
        const numericValue = inputValue.replace(/\D/g, '');
        const limitedValue = numericValue.slice(0, 5);
        input.value = limitedValue;
    });
});
