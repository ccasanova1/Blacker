$(document).ready(function(){
	$("#btn-seguir").click(function(ev){
		var formdata = new FormData($("#frm-seguir")[0]);
		$.ajax({
			url: baseurl+'Sigue/add_sigue',
			type: 'POST',
			data: formdata,
			cache:false,
            contentType:false,
            processData:false,
			success: function(){
				window.location.replace(baseurl+"inicio/pagina/"+id_cuenta);        
			},
			
		});
		ev.preventDefault();
	});

	$("#btn-eliminar").click(function(ev){
		var formdata = new FormData($("#frm-eliminar")[0]);
		$.ajax({
			url: baseurl+'Sigue/eliminar_sigue',
			type: 'POST',
			data: formdata,
			cache:false,
            contentType:false,
            processData:false,
			success: function(){
				window.location.replace(baseurl+"inicio/pagina/"+id_cuenta);       
			},
			
		});
		ev.preventDefault();
	});
	$(document).on("click","#eliminar button",function(){
		var id_usuario = $(this).val();
		$.ajax({
			url: baseurl+'Sigue/bloquear_sigue',
			type: 'POST',
			data: {id_usuario:id_usuario},
			success: function(){
				alert("Se a eliminado de tus seguidores al usuario seleccionado");        
			},
			
		});
		ev.preventDefault();
	});
});