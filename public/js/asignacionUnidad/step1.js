(async () => {
    let id = document.getElementById("id_cliente").value;
    if (id !== "") await searchResponsables(id);
    let responsable = document.getElementById("id_responsable");
    responsable.getAttribute("old") !== "" &&
        (responsable.value = responsable.getAttribute("old"));
    setTimeout(() => {
        document.getElementById("message").remove();
    }, 2000);
})();

async function searchResponsables(id) {
    try {
        const res = await fetch("../getResponsables/" + id).then(
            async (res) => {
                if (res.ok) return res.json();
                throw await res.json();
            }
        );
        document.getElementById("id_responsable").innerHTML =
            `
        <option value="" selected hidden>Seleccionar responsable</option>
        <option disabled>Seleccionar responsable</option>` +
            res
                .map(
                    (item) =>
                        `<option value="${item.id_responsable}">${item.nombre_responsable}</option>`
                )
                .join("");
    } catch (error) {
        console.log(error);
    }
    return;
}

function getFechaFinal() {
    const FI = document.getElementById("fecha_inicial").value;
    if (!FI) return;
    let plazo = document.getElementById("plazo_arrendamiento");
    const fechaInicial = new Date(FI);
    const meses = Number(plazo[plazo.selectedIndex].innerHTML);
    fechaInicial.setMonth(fechaInicial.getMonth() + (isNaN(meses) ? 0 : meses));
    document.getElementById("fecha_final").value = fechaInicial
        .toISOString()
        .split("T")[0];
}

function validarFormulario() {
    const formulario = document.getElementById("form 1");
    if (formulario.checkValidity()) new bootstrap.Modal(document.getElementById('modalAsignacionUnidades')).show();
    else formulario.classList.add("was-validated");
    validateForm(formulario);
}
