$(document).ready(function(){
	$("#btn-seguir").click(function(ev){
		var formdata = new FormData($("#frm-seguir")[0]);
		$.ajax({
			url: baseurl+'Amigos/add_sigue',
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
			url: baseurl+'Amigos/eliminar_sigue',
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
});