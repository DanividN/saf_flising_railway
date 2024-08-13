let garantias = [];
let garantiasAsignadas = [];

var tipos_garantias = document.getElementById("Tipo_garantia");
var tabla = document.getElementById("tablaGarantias");

(() => {
    const tbody = tabla;
    for (const cell of tbody.getElementsByTagName("tr")) {
        garantiasAsignadas.push(cell.id);
    }
    document.getElementById(
        "garantiasAsignadas"
    ).value = `[${garantiasAsignadas}]`;
    if(etapa>2&&garantiasAsignadas.length==0){
        setGarantias(0);
        document.getElementById("Garantia").value=0;
    }
    count();
})();

function setGarantias(e) {
    document.getElementById("tableAgencias").style.display =
        document.getElementById("formAgencias").style.display =
            e == 1 ? "block" : "none";

    document.getElementById("registro").value = e == 1 ? true : false;
}

async function getGarantias(id) {
    try {
        const res = await fetch("../../getGarantias/" + id).then(
            async (res) => {
                if (res.ok) return res.json();
                throw await res.json();
            }
        );
        garantias = res;
        tipos_garantias.innerHTML =
            `
        <option value="" selected hidden>Seleccionar</option>
        <option disabled>Seleccionar</option>` +
            res
                .map(
                    (item) =>
                        `<option value="${item.id_garantia_proveedor}" ${
                            garantiasAsignadas.some(
                                (x) => x == item.id_garantia_proveedor
                            )
                                ? "disabled"
                                : ""
                        }>${item.nombre_g_proveedor}</option>`
                )
                .join("");
    } catch (error) {
        console.log(error);
    }
}

async function agregar() {
    if(tabla.rows[0]?.cells?.length==1)tabla.deleteRow(0);
    const tipo = garantias.find(
        (x) => x.id_garantia_proveedor == tipos_garantias.value
    );
    if(tipo==undefined) return;
    garantiasAsignadas.push(tipo.id_garantia_proveedor);
    tabla.innerHTML += `
    <tr>
    <td>${garantiasAsignadas.length}</td>
    <td>${tipo.nombre_g_proveedor}</td>
    <td>${tipo.vigencia_g_proveedor}</td>
    <td><a href="${ruta+'/'+tipo.a_g_evidencia}" target="_blank">
            <img src="${`${ruta}`.replace('storage','')}img/configuracion/pdf.png" alt="icono.pdf" width="23px">
        </a></td>
    <td>
    <a type='button' onclick='remove(this,${tipo.id_garantia_proveedor})' target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="red" class="bi bi-trash trashed" viewBox="0 0 16 16">
            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
            </svg>
        </a></td>
    </tr>`;
    tipos_garantias.options[tipos_garantias.selectedIndex].disabled = true;
    tipos_garantias.selectedIndex = "";
    document.getElementById(
        "garantiasAsignadas"
    ).value = `[${garantiasAsignadas}]`;
    count();
}

function remove(e, id) {
    garantiasAsignadas.splice(
        garantiasAsignadas.findIndex((e) => e == id),
        1
    );
    document
        .getElementById("table")
        .deleteRow(e.parentNode.parentNode.rowIndex);

    document.getElementById(
        "garantiasAsignadas"
    ).value = `[${garantiasAsignadas}]`;
    for (const option of tipos_garantias.options) if(option.value==id)
        option.disabled = false;
    count();
}

function count() {
    let count = 1;
    for (const row of tabla.rows)
        (row.cells[0].innerHTML = count++), count;
}

function validarFormulario() {
    console.log(document.getElementById("Garantia").value==1,garantiasAsignadas.length);
    if(document.getElementById("Garantia").value==1&&garantiasAsignadas.length==0){
        document.getElementById("tableError").removeAttribute('hidden');
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Valida tus campos",
        });
    }
    else document.getElementById("form3").submit();
}
