
function informe(e) {
    const formValues = {};
    for (let [key, value] of new FormData(e).entries()) formValues[key] = value;
    if (Object.values(formValues).some((x) => x == "")) return;
    
    document.getElementById(
        "DownloadInforme"
    ).href = `./dowloadInforme?${new URLSearchParams(formValues).toString()}`;

    Swal.fire({
        title: "Generando informe!",
        html: "por favor espere!<br>",
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        },
    });
    fetch("./verificacion", {
        headers: {
            "Content-Type": "application/json",
        },
        method: "post",
        body: JSON.stringify(formValues),
    })
        .then(async (res) => {
            swal.close();
            if (res.ok) return res.json();
            throw await res.json();
        })
        .then((res) => {
            let cont=0;
            document.getElementById("tabla").innerHTML = res.map(
                (unidad) =>
                    `
                    <tr class="text-center">
                        <td class="text-start">${++cont}</td>
                        <td>${unidad.ultimo_arrendamiento.placas}</td>
                        <td>${unidad.marca.descripcion}</td>
                        <td>${(unidad.estado[1]?'Primer':'Segundo') + " semestre"}</td>
                        <td>${unidad.ultima_verificacion?.seguimiento?.fecha_verificacion??'Pendiente'}</td>
                        <td>${unidad.ultimo_arrendamiento.cliente.nombre_cliente}</td>
                        <td>${unidad.estado[0]}</td>
                        <td>${unidad.ultima_verificacion?.seguimiento?.monto_verificacion && '$' + unidad.ultima_verificacion.seguimiento.monto_verificacion || 'Pendiente'}</td>
                    </tr>
                `
            ).join('');
        })
        .catch((err) => {
            console.log(err);
        });
}
