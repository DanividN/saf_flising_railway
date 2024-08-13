$(document).ready(function(){
    $('#pass2').keyup(function(){
        var password = $(this).val();
        // var pass2 = $('#pass2').val();
        //Validar longitud
        if(password.length < 6){
            $('#length').removeClass('valid').addClass('invalid');
        }else{
            $('#length').removeClass('invalid').addClass('valid');
        }

        //validar numero
        if ( password.match(/[1-6]/) ) {
            $('#number').removeClass('invalid').addClass('valid');
        } else {
            $('#number').removeClass('valid').addClass('invalid');
        }
    });
    $('.pass').keyup(function(){
        var password = $('#pass').val();
        var pass2 = $('#pass2').val();
        //Validar que coincidan las contraseñas 
        if(password != "" && pass2 != ""){
            //validar confirmación contraseña
            if (password.length == 0 || pass2.length == 0) {
                $('#null').removeClass('valid').addClass('invalid');
            } else {
                $('#null').removeClass('invalid').addClass('valid');
            }
            //validar contraseñas cohincidan
            if (password != pass2) {
                $('#match').removeClass('valid').addClass('invalid');
            } else {
                $('#match').removeClass('invalid').addClass('valid');
            }              
        }
    });
});

function mostrarPassword(){
    var cambio = document.getElementById("pass");
    var cambio2 = document.getElementById("pass2");
    if(cambio.type == "password"){
        cambio.type = "text";
        cambio2.type = "text";
        $('.icon').removeClass('bi bi-eye-fill').addClass('bi bi-eye-slash-fill');           
    }else{
        cambio.type = "password";
        cambio2.type = "password";
        $('.icon').removeClass('bi bi-eye-slash-fill').addClass('bi bi-eye-fill');
    }
}