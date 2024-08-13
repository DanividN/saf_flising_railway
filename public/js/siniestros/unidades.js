$("#id_cliente").on("change", function () {
    var id_cliente = $(this).val();
    $.ajax({
        type: "GET",
        url: siniestroUnidadesUrl,
        data: {
            id_cliente: id_cliente,
        },
        success: function (data) {
            var option = "<option value='' hidden>Seleccionar:</option>";
            for (var i = 0; i < data.length; i++) {
                option +=
                    '<option value="' +
                    data[i].id_unidad +
                    '">' +
                    data[i].placas +
                    " / " +
                    data[i].vehiculo_id +
                    "</option>";
            }
            $("#unidad").empty().html(option);
        },
    });
});

$('#siniestroModal').on('shown.bs.modal', function () {
    $('#id_cliente').select2({
        theme: "bootstrap-5",
        width: function() {
            return $(this).data("width") ? $(this).data("width") : $(this).hasClass("w-100") ? "100%" : 'style';
        },
        placeholder: "Seleccionar:",
        dropdownParent: $('#siniestroModal')
    });
    $('#unidad').select2({
        theme: "bootstrap-5",
        width: function() {
            return $(this).data("width") ? $(this).data("width") : $(this).hasClass("w-100") ? "100%" : 'style';
        },
        placeholder: "Seleccionar:",
        dropdownParent: $('#siniestroModal')
    });
});

