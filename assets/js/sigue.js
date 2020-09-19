$(document).ready(function(){
	$("#btn-seguir").click(function(ev){
		var formdata = new FormData($("#frm-seguir")[0]);
		$.ajax({
			url: baseurl+'Inicio/add_sigue',
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