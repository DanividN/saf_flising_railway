// Sólo número para teléfono
function valideKey(evt){
    // code is the decimal ASCII representation of the pressed key.
    var code = (evt.which) ? evt.which : evt.keyCode;
    // allow backspace and numbers.
    if(code==8) { // backspace.
        return true;
    } else if(code>=48 && code<=57) { // is a number.
        return true;
    } else{ // other keys.
        return false;
    }
}

function getNameDirection(){
    $("#location_search").on('click', function(){
        var nombre_comercial = $("#nombre_comercial").val();
        var direccion = $("#location").val();
        // console.log(nombre_comercial, direccion);
        $("#name_com").val(nombre_comercial);
        $("#direccion_a").val(direccion);
    })
}

$(document).ready(function(){
    new AutoNumeric('#monto_g_proveedor',{
        decimalPlaces: 2,
    });
});
