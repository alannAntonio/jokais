<?php
	session_start();
	if(!($_SESSION["administrador"] == TRUE)){
		header("location:admin.php");
	}else{
		if(($_SESSION['credencial'] != "administrador") && ($_SESSION['credencial'] != "pagos")){
			header("location:admin.php");
		}
	};
?>
<!DOCTYPE html>
<html>
<head>
	<title>Pagos | JOKAIS</title>
	<link rel="shortcut icon" href="images/favicon.png">
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/pagos.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
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
	<h2>Pagos</h2>
	<p>Aquí podrás gestionar los pagos recibidos.</p>
		<div class="menu">
			<div class="opcion" id="listado">Listado</div>
			<div class="opcion" id="ingreso">Ingreso</div>
		</div>
		<div class="contain3">

			<div class="contenedor_listado">
				<div class="contenedor_listado2">
					<table cellspacing="0px" cellpadding="10px">
						<tr>
							<td class="tabla_titulo" id="porCliente" width="50%">Cliente</td>
							<td class="tabla_titulo" id="porUsuario" width="30%">Usuario</td>
							<td class="tabla_titulo" id="porDeuda" >Deuda</td>
						</tr>
						<?php include("listado_clientes.php");?>
					</table>					
				</div>				
			</div>

			<div class="contenedor_ingreso">
				<div id="contenedor_ingreso2">
					<div id="buscar">
						<p>Buscar por número de cliente</p>
						<form class="formulario_buscar" >
							<input type="number" id="cliente" placeholder="N° Cliente">
							<div class="buscar_pagos">Buscar</div>
						</form>
					</div>

					<div class="mostrar">
						<h1>Cliente</h1>
						<h2>Dirección</h2>
						<h2>Útimo pago</h2>
					</div>					
					
					<div id="monto">
						<form id="formulario_pago" >
							<p>Monto a pagar</p>
							<div class="divisor">
								<input type="number" id="total_txt" value="">
							</div>			
							<p>Método pago</p>	
							<select id="metodo">
								<option>Efectivo</option>
								<option selected>Transferencia</option>
								<option>Deposito</option>
							</select>
							<div id="pago">Ingresar Pago</div>
						</form>
					</div>
				</div>
			</div>

		</div>
	</div>
</body>
<script type="text/javascript">

	$(document).ready(function() {
	    $("form").keypress(function(e) {
	        if (e.which == 13) {
	            return false;
	        }
	    });
	    $(".aviso").hide();
	});	
	$(".aviso").click(function () {
		$(".aviso").fadeOut();
	});
	var oID;
	var total_deuda;
	var cliente = "";
	var problema = "";

	$("#listado").click(function () {
		$(".contenedor_listado").show();
		$(".contenedor_ingreso").hide();
		location.reload();
	});
	$("#ingreso").click(function () {
		$(".contenedor_ingreso").show();
		$(".contenedor_listado").hide();
	});
	$(".linea_celeste,.linea_blanco").click(function () {
		$(".contenedor_ingreso").show();
		$(".contenedor_listado").hide();
		oID = $(this).attr("id");
		buscar_pago(oID);
	});
	$("#total").click(function(event){
	   event.preventDefault();
	   $('#total_txt').attr("disabled", false);
	   $('#total_txt').val(total_deuda);
	});
	$(".buscar_pagos").click(function () {
		cliente = $("#cliente").val();
		if(cliente != ""){
			buscar_pago(cliente);
		};
	});
	$("#pago").click(function () {
		if(cliente != ""){
			ingresar_pago(cliente);			
		}else{
			$(".contenido_aviso").html("<div id='x'>x</div><p>Debes cargar información del cliente</p>");
		$(".aviso").fadeIn(250);
		};
	});
	
	function buscar_pago(n){
		$('#cliente').val(n);
		cliente = n;
    	$.post("buscar_pagos.php", {rutBusqueda: n}, function(mensaje){
            $(".mostrar").html(mensaje);  
        });	        		
	};

	function ingresar_pago(c){
			var total_txt = $('#total_txt').val();
			var metodo = $('#metodo').val();
			if(total_txt !=""){
				if(total_txt>0){
					$.post("ingresar_pago.php", {clienteIngresar: c, montoIngresar: total_txt, metodoIngresar: metodo}, function(mensaje) {
		            $(".mostrar").html(mensaje);
		            $("#total_txt").val("");
		        	}); 
				}else{
					$(".contenido_aviso").html("<div id='x'>x</div><p>Debes ingresar un monto mayor a 0.</p>");
		$(".aviso").fadeIn(250);
				};
			}else{
				$(".contenido_aviso").html("<div id='x'>x</div><p>Debes ingresar un monto.</p>");
				$(".aviso").fadeIn(250);
			};
			recargar_clientes();
	};

	function recargar_clientes(){
    	$.post("recargar_clientes.php",{}, function(mensaje){
            $(".contenedor_listado2").html(mensaje);            
        });	        		
	};

</script>
</html>