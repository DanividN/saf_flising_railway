
const consultarApi = async (id_entidad_federativa) => {
    const url = `../../configuracion/garantias_municipios/${id_entidad_federativa}`;
    try {
        const response = await fetch(url);
        const resultado = await response.json();
        const select = document.getElementById('id_municipio');
        select.innerHTML = '<option value="" hidden>--Selecciona--</option>';
        resultado.forEach(municipio => {
            const { id_municipio, nombre_municipio } = municipio;
            const option = document.createElement('option');
            option.value = id_municipio;
            option.text = nombre_municipio;
            select.appendChild(option);
        });
    } catch (error) {
        console.error('Error:', error);
    }
}



const entidadFederativa = document.querySelector('#entidad_g_flising').value;
const municipio = document.querySelector('#municipio_dos').value;

async function consultarApiEdit(id_entidad_federativa, id_municipio_select) {
    // console.log(id_entidad_federativa, id_municipio_select);
    // Acceder a la variable global APP_URL
    const url = `../../../configuracion/garantias_municipios/${id_entidad_federativa}`;
    try {
        const response = await fetch(url);
        const resultado = await response.json();
        const select = document.getElementById('id_municipio');
        select.innerHTML = '<option value="" hidden>--Selecciona--</option>';
        resultado.forEach(municipio => {
            const { id_municipio, nombre_municipio } = municipio;
            const option = document.createElement('option');
            option.value = id_municipio;
            option.text = nombre_municipio;

            if (id_municipio == id_municipio_select) {
                option.setAttribute('selected', 'selected');
            }

            select.appendChild(option);
        });
    } catch (error) {
        // console.error('Error:', error);
    }
}
(() => {
    consultarApiEdit(entidadFederativa, municipio);
})();


document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('editForm');
    const inputs = form.querySelectorAll('input[type="text"], input[type="file"], input[type="email"], input[type="number"],select');
    const submitButton = form.querySelector('input[type="submit"]');


    inputs.forEach(input => {
        input.disabled = true;
        input.style.backgroundColor = '#eee';
        input.style.color = '#ccc';
        input.style.cursor = 'not-allowed';
    });

    submitButton.addEventListener('click', function (e) {
        if (submitButton.value.trim() === 'Editar') {
            e.preventDefault();
            inputs.forEach(input => {
                input.disabled = false;
                input.style.backgroundColor = '';
                input.style.color = '';
                input.style.cursor = '';
            });
            submitButton.value = 'Guardar';
        } else {
            submitButton.value = 'Editar';
        }
    });
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

function convertirAMinusculas(e) {
    e.target.value = e.target.value.toLowerCase();
    validarEmail(e);
}

function validarEmail(e) {
    var emailValue = e.target.value.trim();
    var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if (!emailPattern.test(emailValue)) {
        // Si no es válido, muestra el mensaje de error
        e.target.classList.add("is-invalid");
    } else {
        // Si es válido, elimina el mensaje de error
        e.target.classList.remove("is-invalid");
    }
}

/**Validaciones */
function validateForm(e) {
    e.preventDefault(); // Evitar el envío del formulario hasta que se complete la validación

    var garantia = $("#nombre_g_extendida").val();
    var vigencia = $("#range4").val();
    var montoStr = $("#monto_g_extendida").val().replace(/,/g, ''); // Monto como cadena sin comas
    var monto = Number(montoStr);
    var eventosYear = Number($("#eventos_por_year").val());
    let isValid = true;

    // Validación de 'garantia'
    if (garantia.trim() == '') {
        $("#nombre_g_extendida").addClass("is-invalid");
        isValid = false; // Marcar como inválido
    } else {
        $("#nombre_g_extendida").removeClass("is-invalid");
    }

    // Validación de 'vigencia'
    if (vigencia.trim() == '' || isNaN(vigencia) || vigencia == 0) {
        $("#range4").addClass("is-invalid");
        isValid = false; // Marcar como inválido
    } else {
        $("#range4").removeClass("is-invalid");
    }

    // Validación de 'monto'
    if (isNaN(monto) || monto <= 0) {
        $("#monto_g_extendida").addClass("is-invalid");
        isValid = false; // Marcar como inválido
    } else {
        $("#monto_g_extendida").removeClass("is-invalid");
    }

    // Validación de 'eventos por año'
    if (isNaN(eventosYear) || eventosYear <= 0) {
        $("#eventos_por_year").addClass("is-invalid");
        isValid = false; // Marcar como inválido
    } else {
        $("#eventos_por_year").removeClass("is-invalid");
    }

    // Si hay errores de validación, mostrar la alerta
    if (!isValid) {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Valida tus campos",
        });
    } else {
        const submitButton = $("#guardarBtn");
        submitButton.prop('disabled', true);
        submitButton.text('Guardando...');
        e.currentTarget.submit(); // Envía el formulario si es válido
    }
}
