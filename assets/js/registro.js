$("#seleccion select").change(function(){
    $("#seleccion").removeClass('w3-border-red');
    $("#nombre_pag").removeClass('w3-hide');
    $("#seleccion > div").html('');
    if ($(this).val() == "Pagina" || $(this).val() == "Usuario") {
            if ($(this).val() == "Pagina") {
                $("#nombre").fadeOut(0);
                $("#apellido").fadeOut(0);
                $("#nombre_pag").fadeIn(0);
            };
            if ($(this).val() == "Usuario") {
                $("#nombre").fadeIn(0);
                $("#apellido").fadeIn(0);
                $("#nombre_pag").fadeOut(0);
            }
        } else {
            $("#seleccion").addClass('w3-border-red');
            $("#seleccion > div").html('Usuario Invalido');
        };
})

$("#registrar").click(function (event) {
    event.preventDefault();
    var formdata = new FormData($("#frm-login")[0]);
    $.ajax({
        url: baseurl+'Login/registro',
        type: 'POST',
        data: formdata,
        cache:false,
        contentType:false,
        processData:false,
        success: function () {
            window.location.replace(baseurl);
        },
        error: function (xhr) {
            
            $("input, select").removeClass('w3-border-red');
            $("input, select").removeClass('w3-border-green');
            $("input, select").removeClass('w3-border-red');
            $("input, select").removeClass('w3-border-green');
            if (xhr.status == 400) {
                var json = JSON.parse(xhr.responseText);
                if (json.email.length != 0) {
                    $("#email > div").html(json.email);
                    $("#email > input").addClass('w3-border-red');
                    $("#formulario2").fadeOut(0);
                    $("#formulario1").fadeIn(0);
                }
                if (json.password.length != 0) {
                    $("#password > div").html(json.password);
                    $("#password > input").addClass('w3-border-red');
                    $("#formulario2").fadeOut(0);
                    $("#formulario1").fadeIn(0);
                }
                if (json.rep_password.length != 0) {
                    $("#rep_password > div").html(json.rep_password);
                    $("#rep_password > input").addClass('w3-border-red');
                    $("#formulario2").fadeOut(0);
                    $("#formulario1").fadeIn(0);
                }
                if (json.telefono.length != 0) {
                    $("#telefono > div").html(json.telefono);
                    $("#telefono > input").addClass('w3-border-red');
                    $("#formulario2").fadeOut(0);
                    $("#formulario1").fadeIn(0);
                }
                if (json.pais.length != 0) {
                    $("#pais > div").html(json.pais);
                    $("#pais > select").addClass('w3-border-red');
                    $("#formulario2").fadeOut(0);
                    $("#formulario1").fadeIn(0);
                }
                if (json.seleccion == 'usuario') {
                    if (json.nombre.length != 0) {
                        $("#nombre > div").html(json.nombre);
                        $("#nombre > input").addClass('w3-border-red');
                    }
                    if (json.apellido.length != 0) {
                        $("#apellido > div").html(json.apellido);
                        $("#apellido > input").addClass('w3-border-red');
                    }
                }else{
                    if (json.nombre_pag.length != 0) {
                        $("#nombre_pag > div").html(json.nombre_pag);
                        $("#nombre_pag > input").addClass('w3-border-red');
                    }
                }
                if (json.fecha_nac.length != 0) {
                    $("#fecha_nac > div").html(json.fecha_nac);
                    $("#fecha_nac > input").addClass('w3-border-red');
                }
                $("input, select").addClass('w3-border-green');
                $("input, select").addClass('w3-border-green');
            }
        }
    });
});