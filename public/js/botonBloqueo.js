$(document).ready(function() {
    window.bloqueoBoton = function(event) {
        console.log("bloqueoBoton function called");
        event.preventDefault();
        const form = event.target; // Obtener el formulario del evento

        // Verificar la validez del formulario usando la API de validación de HTML5
        if (!form.checkValidity()) {
            // Mostrar alerta si el formulario no es válido
            Swal.fire({
                title: "Error",
                text: "Hay campos obligatorios vacíos o inválidos, revise nuevamente.",
                icon: "error"
            });
            return false; // Prevenir el envío del formulario
        }

        // Deshabilitar el botón de submit y cambiar el texto
        const submitButton = document.getElementById('guardarBtn');
        if (submitButton) {
            submitButton.disabled = true;
            submitButton.textContent = 'Guardando...';
        }

        // Enviar el formulario
        form.submit();
        return true;
    }
});

