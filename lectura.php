<?php
	session_start();
	if(!($_SESSION["administrador"] == TRUE)){
		header("location:admin.php");
	};
?>
<!DOCTYPE html>
<html>
<head>
	<title>Lectura | JOKAIS</title>
	<link rel="shortcut icon" href="images/favicon.png">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/lectura.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="js/jquery-3.2.1.min.js"></script>
</head>
<body>
	<div class="aviso">
		<div class="contenido_aviso">
			<p>Cargando</p>
		</div>
	</div>
	<div class="contain1">		
		<div class="logo"><img src="images/logo.png"></div>
		<div class="info">
			<p>Bienvenido <?php echo $_SESSION["nombre"]; ?></p>
			<a href="salir_admin.php"><p>Cerrar Sesión</p></a>
		</div>
	</div>
	<div class="contain2">
		<h2>Lectura</h2>
		<p>Con esta herramienta podrás ingresar la lectura de electricidad en tiempo real.</p>
		<div id="menu">
			<div class="listado" id="menu_opcion">Listado</div>
			<div class ="detalle" id="menu_opcion">Detalle</div>
		</div>

		<div id="listado_lectura">
			<div id="contenedor_listado">
				Estado de lecturas del período.
				<?php include("listado_lecturas.php");?>
			</div>
		</div>

		<div id="formulario_lectura">
			<form class="lectura" accept-charset="utf-8" method="POST" autocomplete="off">
				<p><span>1</span>Ingrese el número del medidor</p>
				<input type="number" id="busqueda" name="busqueda" placeholder="N° medidor">				
				<div id="buscar" class="boton">Buscar</div>
				<p><span>2</span>Verifique la información del cliente</p>
				<div class="historial">

					<table>
						<tr>
							<td width="50%">Nombre</td>
							<td>:</td>
							<td></td>
						</tr>
						<tr>
							<td>N° Cliente</td>
							<td>:</td>
							<td></td>
						</tr>
						<tr>
							<td>Dirección</td>
							<td>:</td>
							<td></td>
						</tr>
						<tr>
							<td>Deuda</td>
							<td>:</td>
							<td></td>
						</tr>
						<tr>
							<td>Última lectura</td>
							<td>:</td>
							<td></td>
						</tr>

					</table>
					<div class="respuesta">						
					</div>
				</div>
				<p><span>3</span>Ingrese lectura</p>
				<input type="number" id="lectura" placeholder="Lectura">
				<?php include("mostrar_boton_lectura.php");?>
			</form>
		</div>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function() {
		$(".aviso").hide();
	});
	var medidor = "";
	$(".aviso").click(function () {
		$(".aviso").hide();
	});
	$("#buscar").click(function () {
		buscar();
	});
	$(".listado").click(function () {
		$("#formulario_lectura").hide();
		$("#listado_lectura").show();
		$.post("listado_lecturas2.php", {}, function(mensaje) {
            $("#contenedor_listado").html(mensaje);
        });
	});
	$(".detalle").click(function () {		
		$("#listado_lectura").hide();
		$("#formulario_lectura").show();
	});
	$("#ingresar").click(function () {
		ingresar();
	});
	$("#no_ingresar").click(function () {
		$(".contenido_aviso").html("<div id='x'>x</div><p>El ingreso de lecturas es entre los días 28 y 10 de cada mes.</p>");
		$(".aviso").fadeIn(250);
	});
	$("#aviso").click(function () {
		$(this).hide(200);
	});

	function buscar() {
		medidor = $("#busqueda").val();
	    var textoBusqueda = $("#busqueda").val();	
	    if(textoBusqueda != "") {
	    	$.post("buscar_medidor.php", {valorBusqueda: textoBusqueda}, function(mensaje,estado) {
	            $(".historial").html(mensaje);
	            $(".respuesta").html(estado);
	        });	        
		}else{
			$(".contenido_aviso").html("<div id='x'>x</div><p>Debes ingresar número de medidor</p>");
			$(".aviso").fadeIn(250);
		};
	};

	function ingresar() {
		var textoLectura = $("#lectura").val();
	    if(medidor != "") {  
	    	if(textoLectura != ""){
	    		var estado = $('.estado').attr('id');
	    		if(estado == 'actualizado'){
	    			$(".contenido_aviso").html("<div id='x'>x</div><p>La lectura se encuentra ACTUALIZADA</p>");
			$(".aviso").fadeIn(250);
	    		}else{
	    			$.post("ingresar_lectura.php", {valorIngresar: medidor, valorLectura: textoLectura}, function(mensaje) {
		            $(".historial").html(mensaje);
		            $("#lectura").val("");
		        	});
	    		}	    		
	    	}else{
	    		$(".contenido_aviso").html("<div id='x'>x</div><p>Debes ingresar lectura</p>");
			$(".aviso").fadeIn(250);
	    	} 		    		    	 
		}else{
			$(".contenido_aviso").html("<div id='x'>x</div><p>Debes ingresar número de medidor</p>");
			$(".aviso").fadeIn(250);
		};	    
	};

</script>
</html>