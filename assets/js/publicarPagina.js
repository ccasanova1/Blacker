$(document).ready(function(){

	function recargarEmojis(idc){
	$(idc).emojioneArea({
      pickerPosition: "right",
    });
	}

	var bandera = false;
	var limite = 0;
	$("#publicarTexto").emojioneArea({
      pickerPosition: "right"
    });
    
    if (sigueEstado == "bloqueado") {
		$('#cuerpoPublicaciones').append("<div class='w3-container w3-center w3-card w3-white w3-round w3-margin'><br><p>Esta pagina lo a bloqueado. Ya no podra ver sus publicaciones</p></div>");
	}else{
		$.ajax({
			url: baseurl+'Publicacion/obtenerPuclicacionesPagina',
			type: 'POST',
			data: {id_cuenta:id_cuenta},
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
	}
	

	var banderaScroll = true;

	$(window).on("scroll", function() {
		if (!banderaScroll || sigueEstado == "bloqueado") {
			return
		}
		console.log(limite);
		if (bandera) {
		    if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
		    	banderaScroll = false;	
		        $.ajax({
					url: baseurl+'Publicacion/obtenerPuclicacionesPagina',
					type: 'POST',
					data: {limite:limite,id_cuenta:id_cuenta},
					success: function(resultado){
						resultado = JSON.parse(resultado);
						if (resultado.estado == 'vacio') {
							console.log("entre");
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
					$('#publi_'+id_publicacion+' #comentarios').html('');
					//var json = JSON.parse(resultado.publicacion);
					$.each(JSON.parse(resultado), function(index, value){
						//alert(value);
						console.log(value);
						$('#publi_'+id_publicacion+' #comentarios').append(value.comentarios);
					});
					$('#publi_'+id_publicacion+' #contComentario').val('');
					$('#publi_'+id_publicacion+' #contComentario').text('');
					//$('#cuerpoPiblicaciones').html(resultado); 
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
				$('#Comentario_pers'+id_comentario+' #meGusta #MegustaComentCant').text(resultado.countMegustaComent);
				console.log(resultado.estado);
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
});
	/*$("#contenerComentario button").click(function(){
  console.log('algo');
  console.log($(this).val());
  //alert($(this).val());
});*/





