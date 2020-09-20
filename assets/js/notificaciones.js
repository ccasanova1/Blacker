$(document).ready(function(){   
	$.ajax({
			url: baseurl+'Notificaciones/obtenerNotificaciones',
			type: 'POST',
			success: function(resultado){
				resultado = JSON.parse(resultado);
				if (resultado.estado == 'vacio') {
						$('#cuerpoBusqueda').append(resultado.busqueda);
					bandera = false;
				}else{
					$.each(resultado, function(index, value){
						$('#cuerpoBusqueda').append(value.busqueda);
					});
					limite = 10;
					bandera = true;  
				}
			}
		});
	
	var banderaScroll = true;
	$(window).on("scroll", function() {
		if (!banderaScroll) {
			return
		}
		if (bandera) {
		    if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
		    	banderaScroll = false;	
		        $.ajax({
					url: baseurl+'Notificaciones/obtenerNotificaciones',
					type: 'POST',
					data: {limite:limite},
					success: function(resultado){
						resultado = JSON.parse(resultado);
						if (resultado.estado == 'vacio') {
								$('#cuerpoBusqueda').append(resultado.busqueda);
							bandera = false;
						}else{
							$.each(resultado, function(index, value){
								$('#cuerpoBusqueda').append(value.busqueda);
							});
							bandera = true;
							banderaScroll = true;
							limite = resultado.limite;
						}
					}
				});
		    }
		}
	});
});
