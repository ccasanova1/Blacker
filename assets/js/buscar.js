$(document).ready(function(){
    
    var buscar = $('#publicarBusqueda').val();
    var usuario = $('input:checkbox[id=checkUsuario]:checked').val();  
    var pagina = $('input:checkbox[id=checkPagina]:checked').val();
    var grupo = $('input:checkbox[id=checkGrupo]:checked').val();
	$.ajax({
			url: baseurl+'Inicio/busqueda',
			type: 'POST',
			data: {buscar:buscar,usuario:usuario,pagina:pagina,grupo:grupo},
			success: function(resultado){
				//var json = JSON.parse(resultado.publicacion);
				resultado = JSON.parse(resultado);
				if (resultado.estado == 'vacio') {
						//alert(value);
						$('#cuerpoBusqueda').append(resultado.busqueda);
					bandera = false;
				}else{
					$.each(resultado, function(index, value){
						//alert(value);
						$('#cuerpoBusqueda').append(value.busqueda);
					});
					limite = 10;
					bandera = true;  
				}
			}
		});

	
	var banderaScroll = true;
	//if (banderaPerfil !=) {}
	$(window).on("scroll", function() {
		if (!banderaScroll) {
			return
		}
		if (bandera) {
		    if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
		    	banderaScroll = false;	
		        $.ajax({
					url: baseurl+'Inicio/busqueda',
					type: 'POST',
					data: {limite:limite,buscar:buscar,usuario:usuario,pagina:pagina,grupo:grupo},
					success: function(resultado){
						resultado = JSON.parse(resultado);
						if (resultado.estado == 'vacio') {
								//alert(value);
								$('#cuerpoBusqueda').append(resultado.busqueda);
							bandera = false;
						}else{
							$.each(resultado, function(index, value){
							//alert(value);
								console.log(value);
								$('#cuerpoBusqueda').append(value.busqueda);
							});
							//$('#cuerpoPiblicaciones').html(resultado);
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
	/*$("#contenerComentario button").click(function(){
  console.log('algo');
  console.log($(this).val());
  //alert($(this).val());
});*/





