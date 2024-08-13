const formulario = document.getElementById('form-agregar-validacion-supervision');
const btnEnviar = document.getElementById('btn-agregar-validacion-supervision');

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM cargado');
    formulario?.addEventListener('submit', function(e) {
        e.preventDefault();
        btnEnviar.disabled = true;

        const data = new FormData(e.target);
        const dataObject = Object.fromEntries(data.entries());

        if([dataObject.notificacion_citas, dataObject.observacion_flising].includes('')) {
            Swal.fire({
                title: 'Error',
                text: 'Los campos marcados con * son obligatorios',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
            btnEnviar.disabled = false;
            return;
        }
        
        formulario.submit();
    });
}); 