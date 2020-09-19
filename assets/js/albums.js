$(document).ready(function(){

	function recargarEmojis(idc){
	$(idc).emojioneArea({
      pickerPosition: "right",
    });
	}

	var bandera = false;
	var limite = 0;
	/*$("#publicarTexto").emojioneArea({
      pickerPosition: "right"
    });*/
    
	$.ajax({
			url: baseurl+'Albums/obtenerAlbum',
			type: 'POST',
			data: {id_cuenta:id_cuenta},
			success: function(resultado){
				resultado = JSON.parse(resultado);
				if (resultado.estado == 'vacio') {
					//alert(value);
					$('#cuerpoAlbums').append(resultado.publicacion);
					bandera = false;
				}else{
					$.each(resultado, function(index, value){
						//alert(value);
						$('#cuerpoAlbums').append(value.albums);
						recargarEmojis(value.idc);  
					});
					//$('#cuerpoPiblicaciones').html(resultado);
					limite = 6;
					bandera = true;  
				}	
			}
		});

	$("#frm-album").submit(function(ev){
		ev.preventDefault();
		var formdata = new FormData($("#frm-album")[0]);
		$.ajax({
			url: baseurl+'Albums/nuevoAlbum',
			type: 'POST',
			data: formdata,
			cache:false,
            processData:false,
            contentType:false,
			success: function(){
				location.reload();    
			}
		});
	});

	var banderaScroll = true;
	//if (banderaPerfil !=) {}
	$(window).on("scroll", function() {
		if (!banderaScroll) {
			return
		}
		console.log(limite);
		if (bandera) {
		    if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
		    	banderaScroll = false;	
		        $.ajax({
					url: baseurl+'Albums/obtenerAlbum',
					type: 'POST',
					data: {id_cuenta:id_cuenta,limite:limite},

					success: function(resultado){
						resultado = JSON.parse(resultado);
						if (resultado.estado == 'vacio') {
							//alert(value);
							$('#cuerpoAlbums').append(resultado.publicacion);
							bandera = false;
						}else{
							$.each(resultado, function(index, value){
							//alert(value);
								console.log(value);
								$('#cuerpoAlbums').append(value.albums);
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
    	var id_album = $(this).val();
    	var comentario = $('#album_'+id_album+' #contComentario').val();
    	if (comentario != '') {
	    	$.ajax({
				url: baseurl+'Comentarios/comentarAlbum',
				type: 'POST',
				data: {id_album:id_album,comentario:comentario},
				success: function(resultado){
					$('#album_'+id_album+' #comentarios').html('');
					//var json = JSON.parse(resultado.publicacion);
					$.each(JSON.parse(resultado), function(index, value){
						//alert(value);
						$('#album_'+id_album+' #comentarios').append(value.comentarios);
					});
					$('#album_'+id_album+' #contComentario').val('');
					$('#album_'+id_album+' #contComentario').text('');
					//$('#cuerpoPiblicaciones').html(resultado); 
				}
			});
    	}
  	});

  	$(document).on("click","#Megusta button",function(){
    	var id_album = $(this).val();
    	$.ajax({
			url: baseurl+'Megusta/setMegustaAlbum',
			type: 'POST',
			data: {id_album:id_album},
			success: function(resultado){
				resultado = JSON.parse(resultado);
				$('#album_'+id_album+' #MegustaCant').text(resultado.countMegusta);
				console.log(resultado.estado);
				if (resultado.estado == 'like') {
					$('#album_'+id_album+' #Megusta button').removeClass('w3-theme-d1');
					$('#album_'+id_album+' #Megusta button').addClass('w3-green');
				}else{
					$('#album_'+id_album+' #Megusta button').removeClass('w3-green');
					$('#album_'+id_album+' #Megusta button').addClass('w3-theme-d1');
				}
			}
		});
  	});

  	$(document).on("click",".Comentario_pers button",function(){
    	var id_comentario = $(this).val();
    	$.ajax({
			url: baseurl+'Megusta/setMegustaComentario',
			type: 'POST',
			data: {id_comentario:id_comentario},
			success: function(resultado){
				resultado = JSON.parse(resultado);
				$('#Comentario_pers'+id_comentario+' #MegustaComentCant').text(resultado.countMegustaComent);
				console.log(resultado.estado);
				if (resultado.estado == 'like') {
					$('#Comentario_pers'+id_comentario+' button').removeClass('w3-theme-d1');
					$('#Comentario_pers'+id_comentario+' button').addClass('w3-green');
				}else{
					$('#Comentario_pers'+id_comentario+' button').removeClass('w3-green');
					$('#Comentario_pers'+id_comentario+' button').addClass('w3-theme-d1');
				}
			}
		});
  	});

});