$(document).ready(function(){
	$("#btn-amigo").click(function(ev){
		var formdata = new FormData($("#frm-amigo")[0]);
		$.ajax({
			url: baseurl+'Amigos/add_amigo',
			type: 'POST',
			data: formdata,
			cache:false,
            contentType:false,
            processData:false,
			success: function(){
				window.location.replace(baseurl+"inicio/perfil/"+id_cuenta);      
			},
			
		});
		ev.preventDefault();
	});

	$("#btn-aceptar").click(function(){
		var id = $(this).val();
		$.ajax({
			url: baseurl+'Amigos/aceptar_amigo',
			type: 'POST',
			data: {id:id},
			success: function(){    
			},
			
		});
	});

	$("#btn-rechazar").click(function(){
		var id = $(this).val();
		$.ajax({
			url: baseurl+'Amigos/rechazar_amigo',
			type: 'POST',
			data: {id:id},
			success: function(){    
			},		
		});
	});
});