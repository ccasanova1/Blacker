$(document).ready(function(){
    var banderaChat = true;
	$(function() { // Ojo! uso jQuery, recuerda añadirla al html
        cron(); // Lanzo cron la primera vez
        function cron() {
            if (banderaChat) {
                if (id_usuarioChat != 0) {
                    $.ajax({
                    method: "POST",
                    url: baseurl+"Chat/getChat",
                    data: {id_usuarioChat:id_usuarioChat},
                    success: function(resultado){
                        resultado = JSON.parse(resultado);
                        if (resultado.estado != 'vacio') {
                            $.each(resultado, function(index, value){
                                $(id_chat+' #cuerpoChat').append(value.busqueda);
                            });
                        }
                    }
                    });
                } 
            }
        	 
        }
        setInterval(function() {
            cron();
        }, 5000);
    });

    $(document).on("click", id_chat+" button",function(){
    	var comentarioChat = $(id_chat+' #mandarChat').val();     
    	if (comentarioChat != '') {
            banderaChat = false;
    		$.ajax({
				url: baseurl+'Chat/setChat',
				type: 'POST',
				data: {id_usuarioChat:id_usuarioChat,comentarioChat:comentarioChat},
				success: function(resultado){
					resultado = JSON.parse(resultado);
					if (resultado.estado != 'vacio') {
						$.each(resultado, function(index, value){
							$(id_chat+' #cuerpoChat').append(value.busqueda);
						});
						$(id_chat+' #mandarChat').val('');
						$(id_chat+' #mandarChat').text('');
					}
                    banderaChat = true;
				}
			});
    	}
  	});
});