const modal = document.getElementById('supervisionModal');
const selectCliente = document.getElementById('id_cliente');
const contenidoTabla = document.getElementById('listado-unidades');
const spinner = document.getElementById('spinner');

const formularioSupervision = document.getElementById('form-agendar-supervision');
const btnAgendarSupervision = document.getElementById('btn-agendar-supervision');

const loadAuthFunctions = () => {
    cargarSelect2();
    formularioSupervision?.addEventListener('submit', function (e) {
        e.preventDefault();
        btnAgendarSupervision.disabled = true;

        const data = new FormData(e.target);
        const dataObject = Object.fromEntries(data.entries());

        if([
            dataObject.id_cliente, 
            dataObject.id_usuario, 
            dataObject.fecha_supervision, 
            dataObject.hora
        ].includes('')) {
            Swal.fire({
                title: 'Error',
                text: 'Los campos marcados con * son obligatorios',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
            btnAgendarSupervision.disabled = false;
            return;
        }

        if(!dataObject['unidadesSeleccionadas[]']) {
            Swal.fire({
                title: 'Error',
                text: 'Selecciona al menos una unidad',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
            btnAgendarSupervision.disabled = false;
            return;
        }

        formularioSupervision.submit();
    });
};

const cargarSelect2 = () => {
    document.getElementById('supervisionModal').addEventListener('shown.bs.modal', function () {
        const selectCliente = document.getElementById('id_cliente');
        $(selectCliente).select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#supervisionModal'),
            placeholder: '-- Selecciona una opción --',
        }).on('change', function() {
            cargarUnidadesArrendadas();
        });
    
        const selectUsuario = document.getElementById('id_usuario');
        $(selectUsuario).select2({
            theme: 'bootstrap-5',
            dropdownParent: $('#supervisionModal'),
            placeholder: '-- Selecciona una opción --',
        });
    });
}

const cargarUnidadesArrendadas = async () => {
    spinner.style.display = 'flex';
    const id_cliente = selectCliente.value;

    const response = await fetch(`/flising_saf/public/administracion/supervision/unidades/arrendadas/${id_cliente}`);
    const data = await response.json();

    while (contenidoTabla.firstChild) {
        contenidoTabla.removeChild(contenidoTabla.firstChild);
    }

    if (data.length > 0) {
        data.forEach((unidad, index) => {
            const tr = document.createElement('tr');
            
            tr.innerHTML = `
                <tr class="text-center">
                    <td class="text-center"><input type="checkbox" name="unidadesSeleccionadas[]" id="unidades" value="${unidad.id_unidad}"></td>
                    <td class="text-center">${index + 1}</td>
                    <td class="text-center">${unidad.placas}</td>
                    <td class="text-center">${unidad.unidad.vehiculo_id}</td>
                    <td class="text-center">${unidad.responsable.nombre_responsable}</td>
                    <td class="text-center">${unidad.responsable.numero_empleado}</td>
                </tr>
            `;
            contenidoTabla.appendChild(tr);
        });
    } else {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td colspan="6" class="text-center">No hay unidades arrendadas para este cliente</td>
        `;
        contenidoTabla.appendChild(tr);
    }
    spinner.style.display = 'none';
}

document.addEventListener('DOMContentLoaded', loadAuthFunctions);