$(document).ready(function(){
    $('#password').keyup(function(){
        var password = $(this).val();
        var pass2 = $('#confirm').val();
        //Validar longitud
        if(password.length < 8){
            $('#length').removeClass('valid').addClass('invalid');
        }else{
            $('#length').removeClass('invalid').addClass('valid');
        }
        //validar letra
        if ( password.match(/[A-z]/) ) {
            $('#letter').removeClass('invalid').addClass('valid');
        } else {
            $('#letter').removeClass('valid').addClass('invalid');
        }
        //validar letra mayúscula
        if ( password.match(/[A-Z]/) ) {
            $('#capital').removeClass('invalid').addClass('valid');
        } else {
            $('#capital').removeClass('valid').addClass('invalid');
        }
         //validar numero
        if ( password.match(/\d/) ) {
            $('#number').removeClass('invalid').addClass('valid');
        } else {
            $('#number').removeClass('valid').addClass('invalid');
        }
        //validar numero
        if ( password.match(/[$@$!%*?&]/) ) {
            $('#symbol').removeClass('invalid').addClass('valid');
        } else {
            $('#symbol').removeClass('valid').addClass('invalid');
        }
    });
    $('.pass').keyup(function(){
        var password = $('#password').val();
        var pass2 = $('#confirm').val();
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
    var cambio = document.getElementById("password");
    var cambio2 = document.getElementById("confirm");
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