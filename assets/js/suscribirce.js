$(document).ready(function(){
    	
$("#btn-suscribir").click(function (event) {
    event.preventDefault();
    var formdata = new FormData($("#frm-suscribir")[0]);
    $.ajax({
        url: baseurl+'Inicio/suscribir',
        type: 'POST',
        data: formdata,
        cache:false,
        contentType:false,
        processData:false,
        success: function (result) {
            var json = JSON.parse(result);
            if(json.estado == 'bien'){
            	alert('Se actualizado su cuenta');
            }else if(json.estado = 'error'){
            	alert(json.error);
            }
        },
        error: function (xhr) {
            $(".invalido").html('');
            $("input").removeClass('w3-border-red');
            $("input").removeClass('w3-border-green');
            $("input").removeClass('w3-border-red');
            $("input").removeClass('w3-border-green');
            if (xhr.status == 400) {
                var json = JSON.parse(xhr.responseText);
                    if (json.nombreUsuario.length != 0) {
                        $("#numeroTarjeta > .invalido").html(json.numeroTarjeta);
                        $("#numeroTarjeta > p > input").addClass('w3-border-red');
                    }
                    if (json.apellidoUsuario.length != 0) {
                        $("#vencimientoAño > .invalido").html(json.vencimientoAño);
                        $("#vencimientoAño > p > input").addClass('w3-border-red');
                    }
                    if (json.fechaNacUsuario.length != 0) {
                    	$("#CVC > .invalido").html(json.CVC);
                    	$("#CVC > p > input").addClass('w3-border-red');
                	}
                $("input").addClass('w3-border-green');
                $("input").addClass('w3-border-green');
            }
        }
    });
});
});





