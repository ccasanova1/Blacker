$(document).ready(function(){
	$("#frm-login").submit(function(ev){
		$.ajax({
			url: baseurl+'login/loguear',
			type: 'POST',
			data: $(this).serialize(),
			success: function(){
				window.location.replace(baseurl);
			},
			error: function(xhr){
				$("#activado > div").html('');
				$("#activo > div").html('');
				$("#no_existe > div").html('');
				$("#error > div").html('');
				$("#email > div").html('');
				$("#password > div").html('');
				$("#email > input").removeClass('w3-border-red');
				$("#password > input").removeClass('w3-border-red');
				$("#error").addClass('w3-hide');
				$("#activado").addClass('w3-hide');
				$("#activo").addClass('w3-hide');
				$("#no_existe").addClass('w3-hide');
				if(xhr.status == 400){
					var json = JSON.parse(xhr.responseText);
					if (json.email.length != 0){
						$("#email > div").html(json.email);
						$("#email > input").addClass('w3-border-red');
					}
					if (json.password.length != 0){
						$("#password > div").html(json.password);
						$("#password > input").addClass('w3-border-red');
					}
				}else if(xhr.status == 401){
					var json = JSON.parse(xhr.responseText);
					$("#error").removeClass('w3-hide');
					$("#error > div").html(json.msg);
				}
			}
		});
		ev.preventDefault();
	})
})