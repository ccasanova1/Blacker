$(document).ready(function(){
    	
$("#btn-configurar").click(function (event) {
    event.preventDefault();
    var formdata = new FormData($("#frm-configuracion")[0]);
    $.ajax({
        url: 'configurar',
        type: 'POST',
        data: formdata,
        cache:false,
        contentType:false,
        processData:false,
        success: function () {
            //window.location.href = "./inicio";
        },
        error: function (xhr) {
            
            $("input, select").removeClass('w3-border-red');
            $("input, select").removeClass('w3-border-green');
            $("input, select").removeClass('w3-border-red');
            $("input, select").removeClass('w3-border-green');
            if (xhr.status == 400) {
                var json = JSON.parse(xhr.responseText);
                if (json.seleccion == 'usuario') {
                    if (json.nombreUsuario.length != 0) {
                        $("#nombreUsuario > p > div").html(json.nombreUsuario);
                        $("#nombreUsuario > p > input").addClass('w3-border-red');
                    }
                    if (json.apellidoUsuario.length != 0) {
                        $("#apellidoUsuario > p > div").html(json.apellidoUsuario);
                        $("#apellidoUsuario > p > input").addClass('w3-border-red');
                    }
                    if (json.fechaNacUsuario.length != 0) {
                    	$("#fechaNacUsuario > p > div").html(json.fechaNacUsuario);
                    	$("#fechaNacUsuario > p > input").addClass('w3-border-red');
                	}
                	if (json.paisUsuario.length != 0) {
                    	$("#paisUsuario > p > div").html(json.paisUsuario);
                    	$("#paisUsuario > p > select").addClass('w3-border-red');
                	}
                	if (json.telefonoUsuario.length != 0) {
                    	$("#telefonoUsuario > p > div").html(json.telefonoUsuario);
                    	$("#telefonoUsuario > p > input").addClass('w3-border-red'); 
                	}
                	if (json.estadoSentimentalUsuario.length != 0) {
                    	$("#estadoSentimentalUsuario > p > div").html(json.estadoSentimentalUsuario);
                    	$("#estadoSentimentalUsuario > p > input").addClass('w3-border-red'); 
                	}
                	if (json.ocupacionUsuario.length != 0) {
                    	$("#ocupacionUsuario > p > div").html(json.ocupacionUsuario);
                    	$("#ocupacionUsuario > p > input").addClass('w3-border-red'); 
                	}
                	if (json.generoUsuario.length != 0) {
                    	$("#generoUsuario > p > div").html(json.generoUsuario);
                    	$("#generoUsuario > p > input").addClass('w3-border-red'); 
                	}
                }else{
                    if (json.nombreEntidad.length != 0) {
                        $("#nombreEntidad > p > div").html(json.nombreEntidad);
                        $("#nombreEntidad > p > input").addClass('w3-border-red');
                    }
                    if (json.paisPagina.length != 0) {
                        $("#paisPagina > p > div").html(json.paisPagina);
                        $("#paisPagina > p > select").addClass('w3-border-red');
                    }
                    if (json.numeroPagina.length != 0) {
                        $("#numeroPagina > p > div").html(json.numeroPagina);
                        $("#numeroPagina > p > input").addClass('w3-border-red');
                    }
                    if (json.esquinaPagina.length != 0) {
                        $("#esquinaPagina > p > div").html(json.esquinaPagina);
                        $("#esquinaPagina > p > input").addClass('w3-border-red');
                    }
                    if (json.telefonoPagina.length != 0) {
                        $("#telefonoPagina > p > div").html(json.telefonoPagina);
                        $("#telefonoPagina > p > input").addClass('w3-border-red');
                    }
                    if (json.descripcionPagina.length != 0) {
                        $("#descripcionPagina > p > div").html(json.descripcionPagina);
                        $("#descripcionPagina > p > input").addClass('w3-border-red');
                    }
                }
                $("input, select").addClass('w3-border-green');
                $("input, select").addClass('w3-border-green');
            }
        }
    });
});
});






