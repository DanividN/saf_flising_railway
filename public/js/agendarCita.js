$('#municipio').on('change', function() {
    var id_municipio = this.value;
    //console.log(id_estado);
    fetch('proveedores/' + id_municipio)
        .then(response => response.json())
        .then(data => {
            var option = "<option value='' hidden>Seleccionar:</option>";
            for(var i = 0; i < data.length; i++){
                option += '<option value="' + data[i].id_proveedor + '">' + data[i].nombre_comercial + '</option>';
            }
            $("#proveedores").empty().html(option);
        })
        .catch(error => console.error('Error:', error));
});

$("#proveedores").on('change', function(){
    var id_proveedor = this.value;
    fetch('direccion/' + id_proveedor)
        .then(response => response.json())
        .then(data => {
            // console.log(data);
            $("#direccion_prov").val(data[0].direccion_proveedor);
        })
        .catch(error => console.error('Error:', error));
});

var unidad = $("#unidad_id").val();
console.log(unidad);
    fetch('fecha_mant/' + unidad)
        .then(response => response.json())
        .then(data => {
            var ultima_fecha = moment(data[0].fecha_mantenimiento);
            var today = moment(new Date().toISOString().split('T')[0]);
            var diff_date = (today.diff(ultima_fecha, 'days'));
            $("#periodo_transcurrido").val(diff_date);
        })
    .catch(error => console.error('Error:', error));

$("#cita_submit").on( 'click', function(){
    var formulario = document.getElementById('formulario_citas');
    var estado = $("estado").val();
    var municipio = $("#municipio").val();
    var unidad = $("#unidad_id").val();
    var proveedores = $("#proveedores").val();
    var direccion = $("#direccion_prov").val();
    var tipo = $("#tipo_mantenimiento").val();
    // var periodo = $("#periodo_transcurrido").val();
    var kilometraje = $("#kilometraje").val();
    var fecha = $("#fecha_mantenimiento").val();
    var hora = $("#hora_mantenimiento").val();
    var archivo = $("#input-file").val();
    if (
        estado == '' || 
        municipio == '' || 
        unidad == '' || 
        proveedores == '' ||
        direccion == '' ||
        tipo == '' ||
        kilometraje == '' ||
        fecha == '' ||
        hora == '' ||
        archivo == ''
    ){
        Swal.fire({
            title: "Error al guardar",
            text: "Hay uno o varios campos vacíos. Por favor, revise nuevamente.",
            icon: "error"
        });
    } else {
        formulario.submit();
    }
});

var max_monto = $("#max_mantenimiento").val();
$("#monto_mantenimiento").on("change", function(){
    var monto_mantenimiento = $(this).val();
    var monto_m = monto_mantenimiento.replaceAll(",",'')
    var max_m = max_monto.replaceAll(",",'')
    var monto_mant = parseFloat(monto_m);
    var monto_adv = parseFloat(max_m);
    // console.log(monto_adv);
    if (monto_mant > monto_adv) {
        Swal.fire({
            title: "Monto máximo superado",
            text: "Este mantenimiento requiere ser autorizado para poder realizarse.",
            icon: "warning"
        });
        $("#correctivo").attr('hidden', false);
        $("#preventivo").attr('hidden', true);
        $("#factura").attr('hidden', true);
        $("#check_payment").attr('hidden', true);
        // $("#basic").attr('hidden', true);
        $("#autorizacion").val("Avanzado");
    } else {
        $("#correctivo").attr('hidden', true);
        $("#preventivo").attr('hidden', false);
        $("#factura").attr('hidden', false);
        $("#check_payment").attr('hidden', false);
        // $("#basic").attr('hidden', false);
        $("#autorizacion").val("Básico");
    }
});

$("#pagado").on("change", function(){
    if($(this).is(':checked')){
        $("#pagado_label").val('Pagado');                            
        $("#estatus_pago").val('2');                            
    }else{                   
        $("#pagado_label").val('No pagado'); 
        $("#estatus_pago").val('1');  
    }
});

$("#basico").on("click",function(){
    var cancelado = $("#status_cancelado").val();
    console.log(cancelado);
    var formulario_seguimiento = document.getElementById("form_seguimiento");
    var kilometraje = $("#kilometraje").val();
    var fecha_mant = $("#fecha_mant").val();
    var monto_mantenimiento = $("#monto_mantenimiento").val();
    var cotizacion = $(".cotizacion").val();
    var observaciones = $("#observaciones").val();
    if(cancelado == 'CANCELADO'){
        $("#kilometraje").attr("required", false);
        $("#fecha_mant").attr("required", false);
        $("#monto_mantenimiento").attr("required", false);
        $(".cotizacion").attr("required", false);
        $("#observaciones").attr("required", false);
        formulario_seguimiento.submit();
    }else{
        if(
            kilometraje == '' || 
            fecha_mant == '' || 
            monto_mantenimiento == '' || 
            cotizacion == '' || 
            observaciones == ''
        ){
            Swal.fire({
                title: "Error al guardar",
                text: "Hay uno o varios campos vacíos. Por favor, revise nuevamente.",
                icon: "error"
            });
        }else{
            formulario_seguimiento.submit();
        }
    }
    if(kilometraje == ''){
        $("#empty_kilometraje").attr("hidden", false);
        $("#kilometraje").addClass("invalid_border");
    }else{
        $("#empty_kilometraje").attr("hidden", true);
        $("#kilometraje").removeClass("invalid_border");
    }
    if(fecha_mant == ''){
        $("#empty_fecha").attr("hidden", false);
        $("#fecha_mant").addClass("invalid_border");
    }else{
        $("#empty_fecha").attr("hidden", true);
        $("#fecha_mant").removeClass("invalid_border");
    }
    if(monto_mantenimiento == ''){
        $("#monto_mantenimiento").addClass("invalid_border");
    }else{
        $("#monto_mantenimiento").removeClass("invalid_border");
    }
    if(cotizacion == ''){
        $(".cotizacion").addClass("invalid_border");
    }else{
        $(".cotizacion").removeClass("invalid_border");
    }
    if(observaciones == ''){
        $("#observaciones").addClass("invalid_border");
    }else{
        $("#observaciones").removeClass("invalid_border");
    }
})

$("#avanzado").on("click",function(){
    var formulario_seguimiento = document.getElementById("form_seguimiento");
    var kilometraje = $("#kilometraje").val();
    var fecha_mant = $("#fecha_mant").val();
    var monto_mantenimiento = $("#monto_mantenimiento").val();
    var monto_mantenimiento = $("#monto_mantenimiento").val();
    var cotizacion = $(".cotizacion").val();
    var factura = $(".factura").val();
    var observaciones = $("#observaciones").val();
    if(
        kilometraje == '' || 
        fecha_mant == '' || 
        monto_mantenimiento == '' || 
        cotizacion == '' || 
        observaciones == ''
    ){
        Swal.fire({
            title: "Error al guardar",
            text: "Hay uno o varios campos vacíos. Por favor, revise nuevamente.",
            icon: "error"
        });
        if(kilometraje == ''){
            $("#empty_kilometraje").attr("hidden", false);
            $("#kilometraje").addClass("invalid_border");
        }else{
            $("#empty_kilometraje").attr("hidden", true);
            $("#kilometraje").removeClass("invalid_border");
        }
        if(fecha_mant == ''){
            $("#empty_fecha").attr("hidden", false);
            $("#fecha_mant").addClass("invalid_border");
        }else{
            $("#empty_fecha").attr("hidden", true);
            $("#fecha_mant").removeClass("invalid_border");
        }
        if(monto_mantenimiento == ''){
            $("#monto_mantenimiento").addClass("invalid_border");
        }else{
            $("#monto_mantenimiento").removeClass("invalid_border");
        }
        if(cotizacion == ''){
            $(".cotizacion").addClass("invalid_border");
        }else{
            $(".cotizacion").removeClass("invalid_border");
        }
        if(observaciones == ''){
            $("#observaciones").addClass("invalid_border");
        }else{
            $("#observaciones").removeClass("invalid_border");
        }
    }else{
        formulario_seguimiento.submit();
    }
})

$("#basic_autorizado").on("click", function(){
    var formulario_autorizado = document.getElementById("form_autorizado");
    var factura = $(".factura").val();
    if(factura == ''){
        Swal.fire({
            title: "Error al guardar",
            text: "Debe cargar la factura para poder guardar el registro.",
            icon: "error"
        });
    }else{
        formulario_autorizado.submit();
    }
})