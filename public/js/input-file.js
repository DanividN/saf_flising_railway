document.addEventListener('DOMContentLoaded', function() {
    const inputArchivo = document.getElementById('archivo-input');

    inputArchivo.addEventListener('change', function() {
        if (inputArchivo.files.length > 0) {
            inputArchivo.classList.add('has-file');
        } else {
            inputArchivo.classList.remove('has-file');
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const inputArchivos = document.querySelectorAll('.input-archivo-down');
    inputArchivos.forEach(function(inputArchivo) {
        inputArchivo.addEventListener('change', function() {
            if (inputArchivo.files.length > 0) {
                inputArchivo.classList.add('has-file');
            } else {
                inputArchivo.classList.remove('has-file');
            }
        });
    });
});


document.addEventListener('DOMContentLoaded', function() {
    const inputArchivos = document.querySelectorAll('input[type="file"]');

    inputArchivos.forEach(function(inputArchivo) {
        inputArchivo.addEventListener('change', function() {
            if (inputArchivo.files.length > 0) {
                inputArchivo.classList.add('has-file');
            } else {
                inputArchivo.classList.remove('has-file');
            }
        });
    });
});
