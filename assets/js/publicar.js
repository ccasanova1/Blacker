$(document).ready(function(){

	function recargarEmojis(idc){
	$(idc).emojioneArea({
      pickerPosition: "bottom",
      recentEmojis: false,
    });
	}

	var bandera = false;
	var limite = 0;
	$("#publicarTexto").emojioneArea({
      pickerPosition: "bottom",
      recentEmojis: false,
    });
    
	$.ajax({
			url: baseurl+'Publicacion/obtenerPuclicaciones',
			type: 'POST',
			success: function(resultado){
				resultado = JSON.parse(resultado);
				if (resultado.estado == 'vacio') {
					//alert(value);
					$('#cuerpoPublicaciones').append(resultado.publicacion);
					bandera = false;
				}else{
					$.each(resultado, function(index, value){
						//alert(value);
						$('#cuerpoPublicaciones').append(value.publicacion);
						recargarEmojis(value.idc);
					});
					//$('#cuerpoPiblicaciones').html(resultado);
					limite = 3;
					bandera = true;  
				
				} 
				
			}
		});

	$("#frm-publicar").submit(function(ev){
		ev.preventDefault();
		function getId(url) {
    		var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
    		var match = url.match(regExp);
    		if (match && match[2].length == 11) {
        		return match[2];
    		} else {
        		return 'error';
    		}
		}
		var myId;
    	var myUrl = $('#publicarVideo').val();
    	myId = getId(myUrl);
    	if (myId == 'error') {
    		$('#publicarVideo').val('');
    	}else{
    		$('#publicarVideo').val(myId);
    	}
		var formdata = new FormData($("#frm-publicar")[0]);
		$.ajax({
			url: baseurl+'Publicacion/publicar',
			type: 'POST',
			data: formdata,
			cache:false,
            processData:false,
            contentType:false,
			success: function(resultado){
				if (resultado.length > 0) {
					resultado = JSON.parse(resultado);
					if (resultado.estado == 'limitada') {
						//alert(value);
						alert("Supero el limite de publicaciones diarias. Contrate el servicio Premium para obtener publicaciones ilimitadas.");
					}
				}else{
					location.reload();
				}   
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
					url: baseurl+'Publicacion/obtenerPuclicaciones',
					type: 'POST',
					data: {limite:limite},

					success: function(resultado){
						resultado = JSON.parse(resultado);
						if (resultado.estado == 'vacio') {
							//alert('No se encuentran mas publicaciones');
							$('#cuerpoPublicaciones').append(resultado.publicacion);
							bandera = false;
						}else{
							$.each(resultado, function(index, value){
							//alert(value);
								console.log(value);
								$('#cuerpoPublicaciones').append(value.publicacion);
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
    	var id_publicacion = $(this).val();
    	var comentario = $('#publi_'+id_publicacion+' #contComentario').val();
    	if (comentario != '') {
    		$.ajax({
				url: baseurl+'Comentarios/comentar',
				type: 'POST',
				data: {id_publicacion:id_publicacion,comentario:comentario},
				success: function(resultado){
					resultado = JSON.parse(resultado);
					if (resultado.estodo == 'error') {
						alert('A ocurrido un error, intente mas tarde');
					}else{
						$('#publi_'+id_publicacion+' #comentarios').html('');
						$.each(resultado, function(index, value){
							$('#publi_'+id_publicacion+' #comentarios').append(value.comentarios);
						});
						$('#publi_'+id_publicacion+' #contComentario').val('');
						$('#publi_'+id_publicacion+' #contComentario').text('');
					}
				}
			});
    	}
  	});

  	$(document).on("click","#Megusta button",function(){
    	var id_publicacion = $(this).val();
    	$.ajax({
			url: baseurl+'Megusta/setMegustaPublicacion',
			type: 'POST',
			data: {id_publicacion:id_publicacion},
			success: function(resultado){
				resultado = JSON.parse(resultado);
				$('#publi_'+id_publicacion+' #MegustaCant').text(resultado.countMegusta);
				console.log(resultado.estado);
				if (resultado.estado == 'like') {
					$('#publi_'+id_publicacion+' #Megusta button').removeClass('w3-theme-d1');
					$('#publi_'+id_publicacion+' #Megusta button').addClass('w3-green');
				}else{
					$('#publi_'+id_publicacion+' #Megusta button').removeClass('w3-green');
					$('#publi_'+id_publicacion+' #Megusta button').addClass('w3-theme-d1');
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
				$('#Comentario_pers'+id_comentario+' #MegustaComentCant').text(resultado.countMegustaComent);
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
					id_publicacion = resultado.id_publicacion;
					$('#publi_'+id_publicacion+' #comentarios').html('');
					$.each(resultado, function(index, value){
						$('#publi_'+id_publicacion+' #comentarios').append(value.comentarios);
					});
				}
			}
		});
  	});

  	$(document).on("click","#Compartir button",function(){
    	var id_publicacion = $(this).val();
    	$.ajax({
			url: baseurl+'Compartir/comparte',
			type: 'POST',
			data: {id_publicacion:id_publicacion},
			success: function(resultado){
				resultado = JSON.parse(resultado);
				if (resultado.estado == 'Bien') {
					window.location.replace(baseurl+"inicio/perfil/"+resultado.id_cuenta);
				}else{
					alert("Esta publicacion ya la compartido");
				}
			}
		});
  	});

  	$(document).on("click","#Eliminar button",function(){
    	var id_publicacion = $(this).val();
    	$.ajax({
			url: baseurl+'Publicacion/deletepublicacion',
			type: 'POST',
			data: {id_publicacion:id_publicacion},
			success: function(resultado){
				if (resultado.length > 0) {
					resultado = JSON.parse(resultado);
					if (resultado.estado == 'error') {
						alert('A ocurrido un errror, intente mas tarde');
					}
				}else{
					alert('Se a eliminado la publicacion');
					location.reload();
				}
				
			}
		});
  	});

});






