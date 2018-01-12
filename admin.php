<!DOCTYPE html>
<html>
<head>
	<title>JOKAIS | Acceso Administrativo</title>
	<link rel="shortcut icon" href="images/favicon.png">
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/admin.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="js/jquery-3.2.1.min.js"></script>
</head>
<body>
	<div class="main_contain">
		<img src="images/logo-blanco.png">		
		<form class="formulario_admin">
			<h1>Acceso</h1>
			<input id="username" type="text" name="username" placeholder="Usuario">
			<input id="password"type="password" name="password" placeholder="Contraseña">
			<div id="ingresar">Ingresar</div>
			<div class="mensaje" id="error2">Usuario y/o Password incorrecto.</div>
			<div class="mensaje" id="error">Debe ingresar la información solicitada.</div>
		</form>
	</div>
</body>
<script>
	$("#ingresar").click(function () {
		validar();
	});

	function validar() {
		var username = $("#username").val();
		var password = $("#password").val();
		$("#error").stop().hide(200);
		$("#error2").stop().hide(200);
	    if(username != "" && password != "") {
	    	$.post("login_admin.php", {username:username,password:password}, function(mensaje) {
	    		if(mensaje == "true"){	    			
					$(location).attr('href',"cpanel");
	    		}else{
	    			$("#error2").show(200);           
	    		}	            
	        });	        
		}else{
			$("#error").show(200);
		};
	};
</script>
</html>