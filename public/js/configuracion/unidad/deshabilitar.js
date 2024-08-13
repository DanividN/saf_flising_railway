document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("formulario");
    const editButton = document.getElementById("editar-btn");
    const saveButton = document.getElementById("guardarBtn");

    // Campos que deben permanecer deshabilitados siempre
    const alwaysDisabledFields = ['rfc_proveedor', 'nombre_contacto', 'direccion', 'telefono'];

    // Deshabilitar todos los campos al cargar la página
    Array.from(form.elements).forEach(element => {
        if (element.tagName === "INPUT" || element.tagName === "SELECT" || element.tagName ===
            "TEXTAREA") {
            element.disabled = true;
        }
    });

    // Habilitar los campos al hacer clic en el botón de "Editar"
    editButton.addEventListener("click", function() {
        Array.from(form.elements).forEach(element => {
            if (element.tagName === "INPUT" || element.tagName === "SELECT" || element
                .tagName === "TEXTAREA") {
                if (!alwaysDisabledFields.includes(element.id) && !element.classList
                    .contains("no-editar")) {
                    element.disabled = false;
                }
            }
        });
        editButton.style.display = "none";
        saveButton.style.display = "inline-block";
    });
});
