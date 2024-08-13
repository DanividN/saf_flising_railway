var clienteInput = document.querySelector('#clienteInput');
var unidadInput = document.querySelector('#id_unidad');
var hidden_id_unidad = document.querySelector('#hidden_id_unidad');
var hidden_vehiculo_id = document.querySelector('#hidden_vehiculo_id');
var hidden_id_asignacion_unidad = document.querySelector('#hidden_id_asignacion_unidad');
let selectedGarantias = [];
let idsGarantias = [];

document.addEventListener('DOMContentLoaded', function() {
    $('#modal-asignar-garantias_id').on('shown.bs.modal', function () {
        $('#id_unidad').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#modal-asignar-garantias_id')
        });
    });

    // Llama a obtenerGarantias aquí, si es necesario, con el valor adecuado
    let valorUnidad = $('#hidden_id_unidad').val();
    if (valorUnidad) {
        obtenerGarantias(valorUnidad);
    }
    $('#modal-asignar-garantias_id').on('hidden.bs.modal', function () {
        // Limpia los campos del formulario
        updateHiddenField();
    });

});

async function obtenerGarantias(valor) {
    let url = `../garantia_obtenerGarantias/${valor}`;
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const resultado = await response.json();

        idsGarantias = resultado.map(element => element.id_garantia_proveedor);
        
        const idsEGarantias = resultado.map(element => ({
            id_unidad_garantia: element.id_unidad_garantia,  
            id: element.id_garantia_proveedor, 
            evento_asignado: element.evento_asignado,
            fecha_final: element.fecha_final 
        }));

        const fechaActual = new Date();

        const idsGarantiasFiltrados = idsEGarantias.filter(element => element.evento_asignado > 0 ||  new Date(element.fecha_final) < fechaActual);
    
        document.querySelectorAll('tr[id^="garantia-"]').forEach(fila => {
            fila.style.backgroundColor = ''; // Resetea el color
            const label = fila.querySelector('label.containercheck');
            if (label) {
                label.style.display = ''; // Muestra el label
            }
        });

        if (idsGarantiasFiltrados.length > 0) {

            idsGarantiasFiltrados.forEach(element => {
                const fila = document.querySelector(`#garantia-${element.id}`);
                if (fila) {
                    fila.style.backgroundColor = '#cecbcb'; 
                    const label = fila.querySelector('label.containercheck');
                    const fechaInput = fila.querySelector('.datepicker');
                    if (label) {
                        label.style.display = 'none'; // Oculta el label
                        fechaInput.disabled = true;
                    }
                }
            });
        } else {
            // console.log('No hay garantías disponibles para esta unidad.');
        }

        updateHiddenField();
    } catch (error) {
        // console.error('Error:', error);
    }
}

function updateHiddenField() {
    const hiddenField = document.getElementById('selected_garantias');
    hiddenField.value = JSON.stringify(selectedGarantias);
    const hiddenField_extendidas = document.getElementById('garantia_extendida_base');
    hiddenField_extendidas.value = JSON.stringify(idsGarantias);

}

$('.datepicker').datepicker({
    dateFormat: 'dd/mm/yy',
});
function convertDateFormat(date) {
    const [day, month, year] = date.split('/');
    return `${year}/${month}/${day}`;
}

function toggleDatePickerEdit(checkbox, id_g_flising_extendidas, garantia_nombre_g_extendida, garantia_vigencia_g_extendida, garantia_monto_g_extendida) {
    const row = checkbox.closest('tr');
    const datepickerInput = row.querySelector('.datepicker');
    const hiddenVigenciaInput = row.querySelector('.hidden-vigencia');
    
    if (!datepickerInput) return;

    const vigenciaValue = garantia_vigencia_g_extendida;
    
    if (checkbox.checked) {
        datepickerInput.style.display = 'block';
        $(datepickerInput).datepicker("setDate", null);
        hiddenVigenciaInput.value = vigenciaValue;
        datepickerInput.setAttribute('required', 'required');
        // Inicializa el datepicker si no está inicializado
        $(datepickerInput).datepicker("option", "onSelect", function(dateText) {
            const fechaInicial = convertDateFormat(dateText);
            // console.log("Fecha seleccionada8: " + fechaInicial);

            // Buscar si el elemento ya existe en el array
            const existingGarantia = selectedGarantias.find(item => item.id_g_flising_extendidas === id_g_flising_extendidas);
            console.log(existingGarantia);
            if (existingGarantia) {
                // console.log('object');
                // Si existe, actualizar los valores
                existingGarantia.fecha_inicial = fechaInicial;
                existingGarantia.nombre = garantia_nombre_g_extendida;
                existingGarantia.vigencia = vigenciaValue;
                existingGarantia.monto = garantia_monto_g_extendida;
            } else {
                // Si no existe, agregar un nuevo elemento
                selectedGarantias.push({
                    id_g_flising_extendidas: id_g_flising_extendidas,
                    nombre: garantia_nombre_g_extendida,
                    vigencia: vigenciaValue,
                    monto: garantia_monto_g_extendida,
                    fecha_inicial: fechaInicial
                });
                console.log(selectedGarantias);
            } 
            updateHiddenField();
        });
    } else {
        datepickerInput.style.display = 'none';
        datepickerInput.removeAttribute('required');
        $(datepickerInput).datepicker('setDate', null); // Limpiar la fecha seleccionada
        hiddenVigenciaInput.value = '';
        idsGarantias = idsGarantias.filter(item => item !== id_g_flising_extendidas);
        selectedGarantias = selectedGarantias.filter(item => item.id_g_flising_extendidas !== id_g_flising_extendidas);
        updateHiddenField();
    }
}



function updateFecha(fecha, id_g_flising_extendidas, nombre_g_extendida,id_unidad, vigencia_g_extendida, monto_g_extendida,id_asignacion_unidad, id_unidad_garantia) {

    const existingGarantia = selectedGarantias.find(item => item.id_g_flising_extendidas === id_g_flising_extendidas);
    if (existingGarantia) {
        // Actualizar la fecha y otros detalles si ya existe
        existingGarantia.fecha_inicial = convertDateFormat(fecha);
        existingGarantia.nombre = nombre_g_extendida;
        existingGarantia.vigencia = vigencia_g_extendida;
        existingGarantia.monto = monto_g_extendida;
    } else {
        // Agregar un nuevo elemento si no existe
        selectedGarantias.push({
            id_g_flising_extendidas: id_g_flising_extendidas,
            nombre: nombre_g_extendida,
            vigencia: vigencia_g_extendida,
            monto: monto_g_extendida,
            fecha_inicial: convertDateFormat(fecha),
            id_unidad_garantia:id_unidad_garantia
        });
    }

    updateHiddenField();
}

// console.log(selectedGarantias);