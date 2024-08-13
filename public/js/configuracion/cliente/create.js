function initializeSelect2(selector) {
    $(selector).select2({
        theme: "bootstrap-5",
        width: function() {
            return $(this).data("width") ? $(this).data("width") : $(this).hasClass("w-100") ? "100%" : "style";
        },
        placeholder: "Seleccionar:",
    });
}
initializeSelect2("#id_municipio");
initializeSelect2("#tipo_cliente");
initializeSelect2("#entidad_id");

$("#entidad_id").on('change', function() {
    var id_estado = $(this).val();
    $.ajax({
        type: "GET",
        url: responsableShowUrl,
        data: {
            id_estado: id_estado
        },
        success: function(data) {
            var option = "<option value='' hidden>Seleccionar:</option>";
            for (var i = 0; i < data.length; i++) {
                option += '<option value="' + data[i].id_municipio + '">' + data[i]
                    .nombre_municipio + '</option>';
            }
            $("#id_municipio").empty().html(option);
        }
    })
});

function getNameDirection() {
    $("#location_search").on('click', function() {
        var nombre_cliente = $("#nombre_cliente").val();
        var direccion = $("#location").val();
        $("#name_com").val(nombre_cliente);
        $("#direccion_a").val(direccion);
    })
}
function validarRFC(e) {
    var rfcValue = e.target.value.trim().toUpperCase();
    var rfcPattern = /^([A-ZÑ&]{3,4})(\d{6})([A-Z\d]{3})$/;
    var serverError = document.querySelector('.text-danger[data-error="rfc"]'); // Selecciona el mensaje de error del servidor

    // Si ya hay un error del servidor, no aplicar la validación del cliente
    if (serverError && serverError.textContent.trim().length > 0) {
        return;
    }

    if (!rfcPattern.test(rfcValue)) {
        e.target.classList.add("is-invalid");
    } else {
        e.target.classList.remove("is-invalid");
    }
}

