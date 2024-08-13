let verificentros = [];

(() => {
    $("#agendarCita").on("shown.bs.modal", function () {
        $(".menu").select2({
            theme: "bootstrap-5",
            dropdownParent: $("#agendarCita"),
        });
    });
})();

function modal(id) {
    const form = document.getElementById("FormAgendarCita");
    form.classList.remove("was-validated");
    form.querySelectorAll(".is-invalid").forEach((el) =>
        el.classList.remove("is-invalid")
    );
    form.reset();
    document.getElementById("archivo-input").classList.remove("has-file");

    const url = form.action.split("/");
    url.pop();
    url.push(id);
    form.action = url.join("/");
}

async function searchMunicipios(id) {
    try {
        const res = await fetch(
            (rute == 0 ? "" : ".") + "./verificacion/municipios/" + id
        ).then(async (res) => {
            if (res.ok) return res.json();
            throw await res.json();
        });
        document.getElementById("id_municipio").innerHTML =
            `
        <option value="" disabled selected hidden>Seleccionar</option>` +
            res
                .map(
                    (item) =>
                        `<option value="${item.id_municipio}">${item.nombre_municipio}</option>`
                )
                .join("");
    } catch (error) {
        console.log(error);
    }
}

async function searchVerificentros(id) {
    try {
        const res = await fetch(
            (rute == 0 ? "" : ".") + "./verificacion/verificentros/" + id
        ).then(async (res) => {
            if (res.ok) return res.json();
            throw await res.json();
        });
        verificentros = res;
        document.getElementById("id_verificentro").innerHTML =
            `
        <option value="" disabled selected hidden>Seleccionar</option>` +
            res
                .map(
                    (item) =>
                        `<option value="${item.id_verificentro}">${item.razon_social}</option>`
                )
                .join("");
    } catch (error) {
        console.log(error);
    }
}

function setDireccion(id) {
    document.getElementById("direccion").value = verificentros.find(
        (i) => i.id_verificentro == id
    )?.direccion;
}

function blockBtn(e) {
    if (!validateForm(e)) return;
    if (!validateForm(e)) return;
    const submitButton = document.getElementById("AgendarBtn");
    submitButton.disabled = true;
    submitButton.textContent = "Guardando...";
}

function blockBtnMiCall(e) {
    if (!validateForm(e)) return;
    if (!validateForm(e)) return;
    const submitButton = document.getElementById("GuardarBtn");
    submitButton.disabled = true;
    submitButton.textContent = "Guardando...";
}

function validateForm(e) {
    const formValues = {};
    for (let [key, value] of new FormData(e).entries()) formValues[key] = value;
    if (
        Object.values(formValues).some((x) => {
            if (typeof x == "object") return (x.size??0) == 0;
            else return x == "";
        })
    ) {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Valida tus campos",
        });
        return false;
    }
    return true;
}

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('input[type="file"]').forEach(function (inputArchivo) {
        inputArchivo.addEventListener("change", function () {
            if (this.files[0].name?.split(".").pop().toLowerCase() !== "pdf") {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Por favor, selecciona un formato PDF.",
                });
                this.value = "";
            }
        });
    });
});
