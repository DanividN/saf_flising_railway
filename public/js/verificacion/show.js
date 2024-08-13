function estatus(e) {
    const form = document.getElementById("formSeguimiento");
    const requiredElements = form.querySelectorAll("[required]");
    requiredElements.forEach((element) => {
        element.removeAttribute("required");
    });
    // form.classList.remove("was-validated");
    // form.classList.remove("needs-validation");
}
function multa(e) {
    const form = document.getElementById("monto_multa");
    const form1 = document.getElementById("a_comprobante_multa");
    if (e == "0") {
        form.setAttribute("disabled", "");
        form1.setAttribute("disabled", "");
    } else {
        form.removeAttribute("disabled");
        form1.removeAttribute("disabled");
        form.setAttribute("required", "");
    }
}
