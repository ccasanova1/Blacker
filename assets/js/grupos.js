$(document).ready(function(){

	function recargarEmojis(idc){
	$(idc).emojioneArea({
      pickerPosition: "bottom",
    });
	}

	var bandera = false;
	var limite = 0;
	$("#descripcionGrupo").emojioneArea({
      pickerPosition: "bottom"
    });
    $("#publicarTexto").emojioneArea({
      pickerPosition: "bottom"
    });
    

	$("#frm-grupo").submit(function(ev){
		ev.preventDefault();
		var formdata = new FormData($("#frm-grupo")[0]);
		$.ajax({
			url: baseurl+'Grupos/ingresarGrupo',
			type: 'POST',
			data: formdata,
			cache:false,
            processData:false,
            contentType:false,
			success: function(grupo){
				var nombreGrupo = $("#nombreGrupo").val();
				window.location.replace(baseurl+"Grupos/verGrupo/"+grupo);  
			},
			error: function(xhr){
				$("#nombreGrupoID > .invalido").html('');
				$("#descripcion > .invalido").html('');
				$("#fotoGrupo > .invalido").html('');
				$("#nombreGrupoID > input").removeClass('w3-border-red');
				$("#descripcion > textarea").removeClass('w3-border-red');
				if(xhr.status == 400){
					var json = JSON.parse(xhr.responseText);
					if (json.nombreGrupo.length != 0){
						$("#nombreGrupoID > .invalido").html(json.nombreGrupo);
						$("#nombreGrupoID > input").addClass('w3-border-red');
					}
					if (json.descripcionGrupo.length != 0){
						$("#descripcion > .invalido").html(json.descripcionGrupo);
						$("#descripcion > input").addClass('w3-border-red');
					}
					if (json.foto.length != 0){
						$("#fotoGrupo > .invalido").html(json.foto);
						$("#fotoGrupo > input").addClass('w3-border-red');
					}
				}
			}
		});
	});

	if (id_grupo != '') {
		$.ajax({
			url: baseurl+'Publicacion/obtenerPuclicacionesGrupo',
			type: 'POST',
			data: {id_grupo:id_grupo},
			success: function(resultado){
				$.each(JSON.parse(resultado), function(index, value){
					$('#cuerpoPublicaciones').append(value.publicacion);
					recargarEmojis(value.idc);  
				});
				limite = 3;
				bandera = true;  	
			}
		});
	}

	$("#frm-publicarGrupo").submit(function(ev){
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
		var formdata = new FormData($("#frm-publicarGrupo")[0]);
		$.ajax({
			url: baseurl+'Publicacion/publicarGrupo',
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

	$(window).on("scroll", function() {
		if (!banderaScroll || id_grupo == '') {
			return
		}
		if (bandera) {
		    if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
		    	banderaScroll = false;	
		        $.ajax({
					url: baseurl+'Publicacion/obtenerPuclicacionesGrupo',
					type: 'POST',
					data: {limite:limite,id_grupo:id_grupo},
					success: function(resultado){
						resultado = JSON.parse(resultado);
						if (resultado.estado == 'vacio') {
							alert('No se encuentran mas publicaciones');
							bandera = false;
						}else{
							$.each(resultado, function(index, value){
								$('#cuerpoPiblicaciones').append(value.publicacion);
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
    	var id_publicacion = $(this).val();
    	var comentario = $('#publi_'+id_publicacion+' #contComentario').val();
    	$.ajax({
			url: baseurl+'Comentarios/comentar',
			type: 'POST',
			data: {id_publicacion:id_publicacion,comentario:comentario},
			success: function(resultado){
				$('#publi_'+id_publicacion+' #comentarios').html('');
				$.each(JSON.parse(resultado), function(index, value){
					$('#publi_'+id_publicacion+' #comentarios').append(value.comentarios);
				});
				$('#publi_'+id_publicacion+' #contComentario').val('');
				$('#publi_'+id_publicacion+' #contComentario').text('');
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

  	$(document).on("click","#Megusta button",function(){
    	var id_publicacion = $(this).val();
    	$.ajax({
			url: baseurl+'Megusta/setMegustaPublicacion',
			type: 'POST',
			data: {id_publicacion:id_publicacion},
			success: function(resultado){
				resultado = JSON.parse(resultado);
				$('#publi_'+id_publicacion+' #MegustaCant').text(resultado.countMegusta);
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






