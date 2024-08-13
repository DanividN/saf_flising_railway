// Verificar si hay errores de validación
var hasErrors = typeof $errors !== "undefined" && $errors.any();

if (hasErrors) {
    // Habilitar los campos si hay errores de validación
    $("#formulario").find(":input").prop("disabled", false);
    $("#edit_responsable").hide();
    $("#guardarBtn").show();
}

// Configurar el modal cuando se abre
$("#responsableModal").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget); // Botón que activó el modal
    var modal = $(this);
    var form = modal.find("#formulario"); // Asegúrate de que el ID coincida

    if (button.data("id")) {
        // Editar registro
        var responsableId = button.data("id");
        form.attr("action", responsableUpdateUrl.replace(":id", responsableId));
        form.find("input[name=_method]").val("PUT");

        $.ajax({
            type: "GET",
            url: responsableShowUrl.replace(":id", responsableId),
            success: function (data) {
                llenarFormulario(data, form);
                actualizarEnlaceDeDescarga(data.a_ine_responsable);

                // Deshabilita los campos en modo edición
                form.find(":input").prop("disabled", true);
                $("#edit_responsable").show().prop("disabled", false);
                $("#guardarBtn").hide();
            },
            error: function (xhr, status, error) {
                console.error(
                    "Error al obtener los detalles del responsable:",
                    error
                );
            },
        });
    } else {
        // Crear nuevo registro
        form.attr("action", responsableStoreUrl);
        form.find("input[name=_method]").val("POST");
        form[0].reset();
        $("#VIP").prop("checked", false);
        $("#vipLabel").text("No");
        $("#activo").prop("checked", false);
        $("#activoLabel").text("Inactivo");
        $("#vipHidden").val("0");
        $("#activoHidden").val("0");
        $("#archivo").hide();
        form.find(":input").prop("disabled", false);
        $("#edit_responsable").hide().prop("disabled", true);
        $("#guardarBtn").show();
    }
});

// Habilitar los campos al hacer clic en "Editar"
$("#edit_responsable").on("click", function () {
    var form = $("#formulario");
    form.find(":input").prop("disabled", false);
    $("#edit_responsable").hide();
    $("#guardarBtn").show();
});

// Ajustar los valores de los checkboxes antes de enviar el formulario
$("#formulario").on("submit", function () {
    $("#vipHidden").val($("#VIP").is(":checked") ? "1" : "0");
    $("#activoHidden").val($("#activo").is(":checked") ? "1" : "0");
});

function llenarFormulario(data, form) {
    $("#nombre_responsable").val(data.nombre_responsable);
    $("#cargo").val(data.cargo);
    $("#telefono").val(data.telefono_responsable);
    $("#numero_empleado").val(data.numero_empleado);
    $("#correo").val(data.correo_responsable);
    $("#folio").val(data.folio_ine);
    $("#archivo").val(data.a_ine_responsable);

    if (data.vip) {
        $("#VIP").prop("checked", true);
        $("#vipLabel").text("Sí");
        $("#vipHidden").val("1");
    } else {
        $("#VIP").prop("checked", false);
        $("#vipLabel").text("No");
        $("#vipHidden").val("0");
    }

    if (data.activo) {
        $("#activo").prop("checked", true);
        $("#activoLabel").text("Activo");
        $("#activoHidden").val("1");
    } else {
        $("#activo").prop("checked", false);
        $("#activoLabel").text("Inactivo");
        $("#activoHidden").val("0");
    }
}

function actualizarEnlaceDeDescarga(rutaArchivo) {
    const enlaceDeDescarga = document.querySelector("#archivo");
    if (rutaArchivo) {
        enlaceDeDescarga.href = `${baseStorageUrl}/${rutaArchivo}`;
        enlaceDeDescarga.style.display = "inline-block";
    } else {
        enlaceDeDescarga.href = "";
        enlaceDeDescarga.style.display = "none";
    }
}

function actualizarValorActivo() {
    var checkbox = document.getElementById("activo");
    var activoHidden = document.getElementById("activoHidden");
    var labelEstatus = document.getElementById("activoLabel");

    console.log("Checkbox activo: ", checkbox.checked); // Depuración

    if (checkbox.checked) {
        activoHidden.value = "1";
        labelEstatus.textContent = "Activo";
    } else {
        activoHidden.value = "0";
        labelEstatus.textContent = "Inactivo";
    }
}

// Función para actualizar el valor del checkbox VIP
function actualizarValorVIP() {
    var checkbox = document.getElementById("VIP");
    var vipHidden = document.getElementById("vipHidden");
    var labelVIP = document.getElementById("vipLabel");

    console.log("Checkbox VIP: ", checkbox.checked); // Depuración

    if (checkbox.checked) {
        vipHidden.value = "1";
        labelVIP.textContent = "Sí";
    } else {
        vipHidden.value = "0";
        labelVIP.textContent = "No";
    }
}

// Asegúrate de que estas funciones se llamen cuando los checkboxes cambien
$("#VIP").on("change", actualizarValorVIP);
$("#activo").on("change", actualizarValorActivo);
