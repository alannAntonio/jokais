<!DOCTYPE html>
<html>
<head>
	<title>JOKAIS</title>
	<link rel="shortcut icon" href="images/favicon.png">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="js/jquery-3.2.1.min.js"></script>
</head>
<body>
	<div class="main_contain">
		
		<div class="horizontal_contain">	

			<div class="texto">
				<div class="logo"><img src="images/logo.png"></div>
				<span>Quiénes somos</span>
				<p>Somos una empresa familiar creada ante la propia necesidad y poca oferta de suministro eléctrico en el  sector. Nuestros esfuerzos están orientados a la entrega y mantención de un servicio de alta calidad, como así también a superarnos cada día por medio de nuestro trabajo y gracias a la fidelidad y compromiso de nuestros clientes. Queremos satisfacer con soluciones significativas, ofreciéndo nuestros servicios con integridad y respondiendo oportunamente.</p>			
			</div>
			<div class="formulario_contain">
				<h2>Acceso usuarios</h2>
				<form class="formulario_ingreso">
					<input type="text" id="username" placeholder="Usuario">
					<input type="password" id="password" placeholder="Contraseña">
					<div id="entrar">Entrar</div>
					<div id="aviso"></div>
				</form>
			</div>
			<div class="contacto">
				<span>Contacto</span>
				<p>Carlos Guzmán P. | contacto@jokais.cl | Celular: 569-53138352</p>
				<p id="credito"><a target="_blank" href="https://alann.cl">Desarrollado por  <span>Alann</span></p>
			</div>
		</div>
	</div>
</body>
<script>
	$("#entrar").click(function () {
		entrar();
	});

	function entrar(){
		username = $("#username").val();
		password = $("#password").val();	    
	    if(username == "" || password == ""){
	    	$("#aviso").html("Debes ingresar la información solicitada.");
	    	$("#aviso").fadeIn(250);
	    }else{
	    	$.post("login.php", {username: username,password:password},function(mensaje){
	    		if(mensaje == "false"){
	    			$("#aviso").html("Credenciales incorrectas.");
	            	$("#aviso").fadeIn(250);
	    		}else{
	    			$(location).attr('href',"usuario");
	    		}	            	      
	        });	        			
		};
	};
</script>
</html>