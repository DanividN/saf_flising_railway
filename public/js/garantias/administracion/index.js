var clienteInput = document.querySelector('#clienteInput');
var unidadInput = document.querySelector('#id_unidad');
var hidden_id_unidad = document.querySelector('#hidden_id_unidad');
var hidden_vehiculo_id = document.querySelector('#hidden_vehiculo_id');
var hidden_id_asignacion_unidad = document.querySelector('#hidden_id_asignacion_unidad');
let selectedGarantias = [];
document.addEventListener('DOMContentLoaded', function() {
    $('#modal-asignar-garantias_id').on('shown.bs.modal', function () {
        $('#id_unidad').select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#modal-asignar-garantias_id')
        });

        let valorUnidad = $('#id_unidad').val();
        if (valorUnidad) {
            obtenerGarantias(valorUnidad);
        }
        validarFormulario();
    });

    $('#modal-asignar-garantias_id').on('hidden.bs.modal', function () {
        // Reinicia el estado de las filas
        document.querySelectorAll('tr[id^="garantia-"]').forEach(fila => {
            fila.style.backgroundColor = ''; // Resetea el color
            const label = fila.querySelector('label.containercheck');
            if (label) {
                label.style.display = ''; // Muestra el label
            }
        });

        // Reinicia el estado de los datepickers
        const datepickersInput = document.querySelectorAll('.datepicker');
        // console.log(datepickersInput);
        datepickersInput.forEach(input => {
            input.style.display = 'none';
            input.value = '';
        });

        // Limpia los campos del formulario
        document.getElementById('formulario_extendidas').reset();
        
        // Reinicia la lista de garantías seleccionadas
        selectedGarantias = [];
        updateHiddenField();
    });
});

const obtenerCliente = async (valor) => {
    let url = `./garantia_cliente/${valor}`;
    clienteInput.value = '';  // Eliminar duplicidad

    try {
        const response = await fetch(url);
        if (!response.ok) {
            validarFormulario();
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const resultado = await response.json();
        const { id_asignacion_unidad, id_cliente, id_unidad, cliente: { nombre_cliente } } = resultado;
        clienteInput.value = nombre_cliente;
        hidden_id_unidad.value = id_unidad;
        hidden_id_asignacion_unidad.value = id_asignacion_unidad;
        
        // Llama a obtenerGarantias con el id_unidad
        await obtenerGarantias(id_unidad);
        validarFormulario();
    } catch (error) {
        // console.error('Error:', error);
    }
}

async function obtenerGarantias(valor) {
    let url = `./garantia_obtenerGarantias/${valor}`;
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const resultado = await response.json();
        const idsGarantias = resultado.map(element => ({
            id: element.id_garantia_proveedor,
            fecha_final: element.fecha_final
        }));

        // Primero, reinicia el estado de todas las filas
        document.querySelectorAll('tr[id^="garantia-"]').forEach(fila => {
            fila.style.backgroundColor = ''; // Resetea el color
            const label = fila.querySelector('label.containercheck');
            if (label) {
                label.style.display = ''; // Muestra el label
            }
        });

        if (idsGarantias.length > 0) {
            const fechaActual = new Date();
            fechaActual.setHours(0, 0, 0, 0); // Trunca la hora de la fecha actual

            idsGarantias.forEach(({ id, fecha_final }) => {
                const fila = document.querySelector(`#garantia-${id}`);
                if (fila) {
                    // Parsear la fecha en formato YYYY-MM-DD y ajustar a medianoche
                    const [year, month, day] = fecha_final.split('-').map(Number);
                    const fechaFinal = new Date(year, month - 1, day); // Mes es 0-indexado
                    fechaFinal.setHours(0, 0, 0, 0); // Trunca la hora de la fecha final

                    if (fechaActual <= fechaFinal) {
                        fila.style.backgroundColor = '#ccc';
                        const label = fila.querySelector('label.containercheck');
                        if (label) {
                            label.style.display = 'none'; // Oculta el label
                        }
                    }
                } else {
                    // console.log('object');
                }
            });
        } else {
            // console.log('No hay garantías disponibles para esta unidad.');
        }

    } catch (error) {
        // console.error('Error:', error);
    }
}



// Actualiza el campo hidden con las garantías seleccionadas
function convertDateFormat(date) {
    const [day, month, year] = date.split('/');
    return `${year}/${month}/${day}`;
}
function toggleDatePicker(checkbox, id_g_flising_extendidas, garantia_nombre_g_extendida, garantia_vigencia_g_extendida, garantia_monto_g_extendida) {
    const row = checkbox.closest('tr');
    const datepickerInput = row.querySelector('.datepicker');
    // console.log(datepickerInput);
    const hiddenVigenciaInput = row.querySelector('.hidden-vigencia');
    const vigenciaValue = garantia_vigencia_g_extendida;

    // Elimina cualquier event listener previo del datepickerInput
    if (datepickerInput.dateChangeListener) {
        datepickerInput.removeEventListener('change', datepickerInput.dateChangeListener);
        delete datepickerInput.dateChangeListener;
    }

    if (checkbox.checked) {
        datepickerInput.style.display = 'block';
        $(datepickerInput).datepicker("setDate", null); // Resetea la fecha seleccionada
        hiddenVigenciaInput.value = vigenciaValue;
        datepickerInput.setAttribute('required', 'required');
        // Verifica si el id_g_flising_extendidas ya está en el arreglo
        const existingGarantia = selectedGarantias.find(item => item.id_g_flising_extendidas === id_g_flising_extendidas);
        if (!existingGarantia) {
            // Define el event listener
            function dateChangeListener(dateText) {
                const fechaInicial = convertDateFormat(dateText);
                
                const exists = selectedGarantias.some(garantia => garantia.id_g_flising_extendidas === id_g_flising_extendidas);

                if (!exists) {
                    selectedGarantias.push({
                        id_g_flising_extendidas: id_g_flising_extendidas,
                        nombre: garantia_nombre_g_extendida,
                        vigencia: vigenciaValue,
                        monto: garantia_monto_g_extendida,
                        fecha_inicial: fechaInicial
                    });
                }

                // console.log(selectedGarantias);
                updateHiddenField();
            }

            // Agrega el event listener y lo almacena en un atributo del input
            $(datepickerInput).datepicker("option", "onSelect", dateChangeListener);
            datepickerInput.dateChangeListener = dateChangeListener;
        }
    } else {
        $(datepickerInput).datepicker("hide");
        datepickerInput.style.display = 'none';
        datepickerInput.value = '';
        hiddenVigenciaInput.value = '';
        datepickerInput.removeAttribute('required');

        // Remover el elemento del array
        selectedGarantias = selectedGarantias.filter(item => item.id_g_flising_extendidas !== id_g_flising_extendidas);
        updateHiddenField();

        // Elimina el event listener
        if (datepickerInput.dateChangeListener) {
            $(datepickerInput).datepicker("option", "onSelect", null);
            delete datepickerInput.dateChangeListener;
        }
    }
}

function updateHiddenField() {
    const hiddenField = document.getElementById('selected_garantias');
    hiddenField.value = JSON.stringify(selectedGarantias);
}

function validarFormulario() {
    const lista = document.querySelectorAll('.lista');

    if (clienteInput.value === '' || unidadInput.value === '') {
        const alertaMensaje = document.createElement('div');
        alertaMensaje.classList.add('alert', 'alert-danger', 'alert-dismissible', 'fade');
        alertaMensaje.textContent = 'Campos Obligatorios';
        document.body.appendChild(alertaMensaje);
        lista.forEach(elemento => {
            document.querySelector('#formulario_extendidas').reset();
            elemento.disabled = true;
        });

    } else {
        lista.forEach(elemento => {
            elemento.disabled = false;
        });
        // console.log('paso');
    }
}
