$(document).ready(function(){

	function recargarEmojis(idc){
	$(idc).emojioneArea({
      pickerPosition: "right",
      recentEmojis: false,
    });
	}

	var bandera = false;
	var limite = 0;
    
	$.ajax({
			url: baseurl+'Albums/obtenerFotos',
			type: 'POST',
			data: {id_cuenta:id_cuenta,id_album:id_album},
			success: function(resultado){
				resultado = JSON.parse(resultado);
				if (resultado.estado == 'vacio') {
					$('#cuerpoFotos').append(resultado.publicacion);
					bandera = false;
				}else{
					$.each(resultado, function(index, value){
						$('#cuerpoFotos').append(value.fotos);
						recargarEmojis(value.idc);  
					});
					limite = 3;
					bandera = true;  
				}
			}
		});

	var banderaScroll = true;
	$(window).on("scroll", function() {
		var scrollHeight = $(document).height();
		var scrollPosition = $(window).height() + $(window).scrollTop();
		if (!banderaScroll) {
			return
		}
		if (bandera) {
		    if((scrollHeight - scrollPosition) / scrollHeight === 0) {
		    	banderaScroll = false;	
		        $.ajax({
					url: baseurl+'Albums/obtenerFotos',
					type: 'POST',
					data: {id_cuenta:id_cuenta,limite:limite,id_album:id_album},
					success: function(resultado){
						resultado = JSON.parse(resultado);
						if (resultado.estado == 'vacio') {
							$('#cuerpoFotos').append(resultado.publicacion);
							bandera = false;
						}else{
							$.each(resultado, function(index, value){
								$('#cuerpoFotos').append(value.fotos);
								recargarEmojis(value.idc);  
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
	$(document).on("click","#contenerComentario button",function(){
    	var id_foto = $(this).val();
    	var comentario = $('#fotos_'+id_foto+' #contComentario').val();
    	if (comentario != '') {
    		$.ajax({
				url: baseurl+'Comentarios/comentar',
				type: 'POST',
				data: {id_publicacion:id_foto,comentario:comentario},
				success: function(resultado){
					$('#fotos_'+id_foto+' #comentarios').html('');
					$.each(JSON.parse(resultado), function(index, value){
						$('#fotos_'+id_foto+' #comentarios').append(value.comentarios);
					});
					$('#fotos_'+id_foto+' #contComentario').val('');
					$('#fotos_'+id_foto+' #contComentario').text('');
				}
			});
    	}
  	});

  	$(document).on("click","#Megusta button",function(){
    	var id_foto = $(this).val();
    	$.ajax({
			url: baseurl+'Megusta/setMegustaPublicacion',
			type: 'POST',
			data: {id_publicacion:id_foto},
			success: function(resultado){
				resultado = JSON.parse(resultado);
				$('#fotos_'+id_foto+' #MegustaCant').text(resultado.countMegusta);
				if (resultado.estado == 'like') {
					$('#fotos_'+id_foto+' #Megusta button').removeClass('w3-theme-d1');
					$('#fotos_'+id_foto+' #Megusta button').addClass('w3-green');
				}else{
					$('#fotos_'+id_foto+' #Megusta button').removeClass('w3-green');
					$('#fotos_'+id_foto+' #Megusta button').addClass('w3-theme-d1');
				}
			}
		});
  	});

  	$(document).on("click",".Comentario_pers #EliminarComent button",function(){
    	var id_comentario = $(this).val();
    	$.ajax({
			url: baseurl+'Comentarios/deleteComentario',
			type: 'POST',
			data: {id_comentario:id_comentario},
			success: function(resultado){
				resultado = JSON.parse(resultado);
				if (resultado.estado == 'error') {
					alert(resultado.error);
				}else{
					id_foto = resultado.id_publicacion;
					$('#fotos_'+id_foto+' #comentarios').html('');
					$.each(resultado, function(index, value){
						$('#fotos_'+id_foto+' #comentarios').append(value.comentarios);
					});
				}
			}
		});
  	});

  	$(document).on("click",".Comentario_pers #meGusta button",function(){
    	var id_comentario = $(this).val();
    	$.ajax({
			url: baseurl+'Megusta/setMegustaComentario',
			type: 'POST',
			data: {id_comentario:id_comentario},
			success: function(resultado){
				resultado = JSON.parse(resultado);
				$('#Comentario_pers'+id_comentario+' #meGusta #MegustaComentCant').text(resultado.countMegustaComent);
				if (resultado.estado == 'like') {
					$('#Comentario_pers'+id_comentario+' #meGusta button').removeClass('w3-theme-d1');
					$('#Comentario_pers'+id_comentario+' #meGusta button').addClass('w3-green');
				}else{
					$('#Comentario_pers'+id_comentario+' #meGusta button').removeClass('w3-green');
					$('#Comentario_pers'+id_comentario+' #meGusta button').addClass('w3-theme-d1');
				}
			}
		});
  	});

});