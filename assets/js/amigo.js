$(document).ready(function(){
	$("#btn-amigo").click(function(ev){
		console.log($("#id-amigo").serialize())
		var formdata = new FormData($("#frm-amigo")[0]);
		$.ajax({
			url: 'http://192.168.2.202/frontend/inicio/add_amigo',
			type: 'POST',
			data: formdata,
			cache:false,
            contentType:false,
            processData:false,
			success: function(){
				$("#btn-amigo").html("Pendiente");
                $("#btn-amigo").addClass('w3-pale-green');
                document.getElementById("btn-amigo").disabled = true;       
			},
			
		});
		ev.preventDefault();
	})

	$("#btn-aceptar").click(function(){
		var id = $(this).val();
		$.ajax({
			url: 'http://192.168.2.202/frontend/inicio/aceptar_amigo',
			type: 'POST',
			data: {id:id},
			success: function(){    
			},
			
		});
	})

	$("#btn-rechazar").click(function(){
		var id = $(this).val();
		$.ajax({
			url: 'http://192.168.2.202/frontend/inicio/rechazar_amigo',
			type: 'POST',
			data: {id:id},
			success: function(){    
			},
			
		});
	})
	
})