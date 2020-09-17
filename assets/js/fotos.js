$(document).ready(function(){

	function recargarEmojis(idc){
	$(idc).emojioneArea({
      pickerPosition: "right",
      recentEmojis: false,
    });
	}

	var bandera = false;
	var limite = 0;
	/*$("#publicarTexto").emojioneArea({
      pickerPosition: "right"
    });*/
    
	$.ajax({
			url: baseurl+'Albums/obtenerFotos',
			type: 'POST',
			data: {id_cuenta:id_cuenta,id_album:id_album},
			success: function(resultado){
				//var json = JSON.parse(resultado.publicacion);
				$.each(JSON.parse(resultado), function(index, value){
					//alert(value);
					$('#cuerpoFotos').append(value.fotos);
					recargarEmojis(value.idc);  
				});
				//$('#cuerpoPiblicaciones').html(resultado);
				limite = 3;
				bandera = true;  
				
			}
		});

	var banderaScroll = true;
	//if (banderaPerfil !=) {}
	$(window).on("scroll", function() {
		var scrollHeight = $(document).height();
		var scrollPosition = $(window).height() + $(window).scrollTop();
		if (!banderaScroll) {
			return
		}
		console.log(limite);
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
							alert('No se encuentran mas publicaciones');
							bandera = false;
						}else{
							$.each(resultado, function(index, value){
							//alert(value);
								console.log(value);
								$('#cuerpoFotos').append(value.fotos);
								recargarEmojis(value.idc);  
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
	$(document).on("click","#contenerComentario button",function(){
    	var id_foto = $(this).val();
    	var comentario = $('#fotos_'+id_foto+' #contComentario').val();
    	$.ajax({
			url: baseurl+'Comentarios/comentar',
			type: 'POST',
			data: {id_publicacion:id_foto,comentario:comentario},
			success: function(resultado){
				$('#fotos_'+id_foto+' #comentarios').html('');
				//var json = JSON.parse(resultado.publicacion);
				$.each(JSON.parse(resultado), function(index, value){
					//alert(value);
					$('#fotos_'+id_foto+' #comentarios').append(value.comentarios);
				});
				$('#fotos_'+id_foto+' #contComentario').val('');
				$('#fotos_'+id_foto+' #contComentario').text('');
				//$('#cuerpoPiblicaciones').html(resultado); 
			}
		});
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
				console.log(resultado.estado);
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

});