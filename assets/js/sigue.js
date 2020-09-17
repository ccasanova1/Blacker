$(document).ready(function(){
	$("#btn-seguir").click(function(ev){
		console.log($("#id-seguir").serialize())
		var formdata = new FormData($("#frm-seguir")[0]);
		$.ajax({
			url: 'http://localhost/frontend/inicio/add_amigo',
			type: 'POST',
			data: formdata,
			cache:false,
            contentType:false,
            processData:false,
			success: function(){
				$("#btn-seguir").html("Siguiendo");
                $("#btn-seguir").addClass('w3-pale-green');
                document.getElementById("btn-seguir").disabled = true;       
			},
			
		});
		ev.preventDefault();
	})
	
})