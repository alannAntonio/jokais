<?php
	session_start();
	if(!($_SESSION["usuario"] == TRUE)){		
		header("location:index.php");
	}else{
		if (time() - $_SESSION["tiempo"] > 3600) {
	    	session_destroy();
	    	header("location:index.php");
	    	die();
		}
	//echo $_SESSION["modificacion"];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>JOKAIS | Usuarios</title>
	<link rel="shortcut icon" href="images/favicon.png">
	<link rel="stylesheet" type="text/css" href="css/usuario.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="js/jquery-3.2.1.min.js"></script>
</head>
<body>

	<div id="actualizar">
		<div id="x">x</div>
		<div id="contenido_actualizar">			
			<div id="formulario_password">
				<h2>Para resguardar tu información, te sugerimos modificar tu clave de acceso. Elige una entre 4 y 8 caractéres.<br><br> ¡Sólo tomará un minuto!</h2>
				<p>Nueva clave *</p>
				<input type="password" id="pass1" maxlength="8">
				<p>Repetir nueva clave *</p>
				<input type="password" id="pass2" maxlength="8">
				<input type="text" id="username" value=<?php echo '"'.$_SESSION["rut"].'"'; ?> hidden>
				<input type="text" id="modificacion" value=<?php echo '"'.$_SESSION["modificacion"].'"'; ?> hidden>
				<h4 id="iguales">Las claves no coinciden.</h4>
				<div id="submit">Actualizar</div>
				<h4 id="obligatorio">*Campos obligatorios.</h4>
			</div>			
		</div>		
	</div>

	<div class="contenedor1">
		<div class="logo">
			<img src="images/logo.png">
		</div>
		<div class="info">
			<p><span><?php echo $_SESSION["nombre"];?></span></p>
			<p>Bienvenido</p>
			<a href="salir.php"><p>Salir</p></a>			
		</div>
	</div>

	<div class="contenedor2">
		<?php include("rescatar_ultima_boleta.php");?>	
	</div>

</body>
<script>	
	var value;
	var estado = false;
	var username = $("#username").val();
	var modificacion = $("#modificacion").val();
	$(document).ready(function() {
		if(modificacion == "0"){
			setTimeout(actualizar,4000);
		}		
	});
	window.onload = (function(){
	try{
	    $("#pass1").on('keyup', function(){
	        value = $(this).val().length;	     
	        if(value<4){
	        	$("#pass2").attr('disabled', 'disabled');
	        }else{
	        	$("#pass2").removeAttr("disabled");
	        }      
	    }).keyup();
	}catch(e){}});

	$("#pass2").keyup(function () {
		var pass1 = $("#pass1").val();
		var	pass2 = $("#pass2").val();
		if(pass2.length >= pass1.length){
			if(pass1 != pass2){
				$("#iguales").fadeIn(200);
				$('#submit').css('background-color', '#FF4747');
				$('#submit').css('border', '#FF4747 1px solid');
				estado = false;
			}else{
				$("#iguales").fadeOut(200);
				$('#submit').css('background-color', '#07DB77');
				$('#submit').css('border', '#07DB77 1px solid');
				estado = true;	
			}
		}else{
			$("#iguales").fadeIn(200);
			$('#submit').css('background-color', '#FF4747');
			$('#submit').css('border', '#FF4747 1px solid');
			estado = false;
		}				
	});


	$("#pass1").focus(function () {
		$("#pass2,#pass1").val("");
		$("#pass2").attr('disabled', 'disabled');
		$('#submit').css('background-color', '#FF4747');
		$('#submit').css('border', '#FF4747 1px solid');
		estado = false;
	});
	$("#x").click(function () {
		$("#actualizar").fadeOut(300);
	});

	$("#submit").click(function() {
		var pass1 = $("#pass1").val();
		var	pass2 = $("#pass2").val();	
		if(pass1 == "" || pass2 == ""){
			$("#obligatorio").stop().animate({ fontSize : '1em' },200);	
		}
		if(estado == true){
			$.post("actualizar_password.php", {pass1: pass1,username:username}, function(mensaje) {				
	            $("#formulario_password").html(mensaje);
	            $("#x").hide();
	            setTimeout(redireccionar,5000);
	        });		        
		}
	  
	});
	function actualizar(){
		$("#actualizar").fadeIn(600);
	}
	function redireccionar(){
		location.href ="index.php";
	}
</script>
</html>