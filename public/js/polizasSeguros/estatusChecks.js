$("#active").on("change", function(){
    $("#active_label").val("Inactivo");
});
$("#active").on("change", function(){
    if($(this).is(":checked")){
        $("#active_label").val("Activo");
    }
});
