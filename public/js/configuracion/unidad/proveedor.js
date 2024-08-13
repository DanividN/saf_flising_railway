$(document).ready(function() {
    console.log('Script JS compartido cargado');

    $("#id_proveedor").on('change', function() {
        var id_proveedor = $(this).val();
        $.ajax({
            type: "GET",
            url: responsableShowUrl, // Asegúrate de definir responsableShowUrl en tu vista
            data: { id_proveedor: id_proveedor },
            success: function(data) {
                $('#rfc_proveedor').val(data[0].rfc_proveedor);
                $('#nombre_contacto').val(data[0].nombre_contacto);
                $('#direccion').val(data[0].calle_proveedor);
                $('#telefono').val(data[0].telefono_proveedor);
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud AJAX:", status, error);
            }
        });
    });
});
