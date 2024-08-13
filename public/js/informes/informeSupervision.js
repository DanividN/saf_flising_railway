const selestMes = document.getElementById('mes');
const inputIdCliente = document.querySelector('#id_cliente');
const inputYear = document.querySelector('#year');
const inputStatus = document.querySelector('#estatus');
const btnGenerarInforme = document.querySelector('#generar_informe');
const cuerpoTabla = document.querySelector('#resultados_informe');
const spinner = document.querySelector('#loading');
const btnImportarExcel = document.querySelectorAll('.informe-excel-sipervision');

document.addEventListener('DOMContentLoaded', function () {
    generarMeses();
    mostrarResultados();
});

const generarMeses = () => {
    let meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    let html = '<option value="">Seleccione un mes</option>';

    meses.forEach((mes, index) => html += `<option value="${index + 1}">${mes}</option>` );

    selestMes.innerHTML = html;
};

const mostrarResultados = async () => {
    btnGenerarInforme.addEventListener('click', async (e) => {
        const mes = selestMes.value;
        const idCliente = inputIdCliente.value;
        const year = inputYear.value;
        const status = inputStatus.value;

        if([mes, idCliente, year, status].includes('')) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Todos los campos son obligatorios'
            });

            return;
        }
        const urlExcel = `/flising_saf/public/administracion/supervision/citas/informe/excel/cliente/${idCliente}/status/${status}/anio/${year}/mes/${mes}`;
        btnImportarExcel.forEach(btn => btn.href = urlExcel);

        const url = `/flising_saf/public/administracion/supervision/citas/informe/resultados`;
        const data = { mes, idCliente, year, status };

        spinner.style.display = 'flex';
        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('#token').value
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();
            console.log(result);
            let html = '';
            if(result.length > 0) {
                result.forEach((cita, index) => {
                    html += `
                        <tr class="text-center">
                            <td>${index + 1}</td>
                            <td>${cita.unidad.tipo_unidad.descripcion}</td>
                            <td>${cita.asignacion_unidad.placas}</td>
                            <td>${cita.cliente.nombre_cliente}</td>
                            <td>${cita.supervisor.name}</td>
                            <td>${cita.fecha_supervision}</td>
                            <td>${cita.notificacion_citas.charAt(0).toUpperCase() + cita.notificacion_citas.slice(1).toLowerCase()}</td>
                        </tr>
                    `;
                });
            } else {
                html = `<tr><td colspan="7" class="text-center">No se encontraron resultados</td></tr>`;
            }

            spinner.style.display = 'none';
            cuerpoTabla.innerHTML = html;
        } catch (error) {
            spinner.style.display = 'none';
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Ocurrió un error al generar el informe'
            });
        }
    })
}