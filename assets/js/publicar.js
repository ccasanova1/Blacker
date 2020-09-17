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
				if (resultado.estado == 'limitada') {
					//alert(value);
					alert("Supero el limite de publicaciones diarias. Contrate el servicio Premium para obtener publicaciones limitadas.");
					bandera = false;
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
    	$.ajax({
			url: baseurl+'Comentarios/comentar',
			type: 'POST',
			data: {id_publicacion:id_publicacion,comentario:comentario},
			success: function(resultado){
				$('#publi_'+id_publicacion+' #comentarios').html('');
				//var json = JSON.parse(resultado.publicacion);
				$.each(JSON.parse(resultado), function(index, value){
					//alert(value);
					$('#publi_'+id_publicacion+' #comentarios').append(value.comentarios);
				});
				$('#publi_'+id_publicacion+' #contComentario').val('');
				$('#publi_'+id_publicacion+' #contComentario').text('');
				//$('#cuerpoPiblicaciones').html(resultado); 
			}
		});
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

});
	/*$("#contenerComentario button").click(function(){
  console.log('algo');
  console.log($(this).val());
  //alert($(this).val());
});*/





