<?php
	session_start();
	if(!($_SESSION["administrador"] == TRUE)){
		header("location:admin.php");
	}else{
		if($_SESSION['credencial'] != "administrador"){
			header("location:admin.php");
		}
	};
?>
<!DOCTYPE html>
<html>
<head>
	<title>Boletas | JOKAIS</title>
	<link rel="shortcut icon" href="images/favicon.png">
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/boletas.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="js/jquery-3.2.1.min.js"></script>
</head>
<body>
	<div class="contenedor_cargando">
			<div id="cargando" class="uno">Cargando...</div>
	</div>
	<div class="contain1">
		<div class="logo"><img src="images/logo.png"></div>
		<div class="info">
			<p>Bienvenido <?php echo $_SESSION["nombre"]; ?></p>
			<a href="salir_admin.php"><p>Cerrar Sesión</p></a>
		</div>
	</div>

	<div class="contain2">
		<h2>Boletas</h2>
		<p>Gestiona y emite tus boletas</p>
	</div>

	<div class="contain3">
		<div class="pestanas">
			<div class="opcion" id="emision">Gestion</div>
			<div class="opcion" id="gestion">Detalle</div>
		</div>

		<div class="contenido_gestion">
			<div id="contenido_gestion">
				<div class="numero_boleta">
					<p>Buscar por n° de boleta</p>
					<input type="number" id="numero_boleta" class="input_gde" placeholder="N° Boleta">
					<div class="btn_buscar" id="buscar_numero_boleta">Buscar</div>
				</div>
				<div class="mostrar">					
				</div>	
			</div>
		</div>

		<div class="contenido_detalle">
			<div id="contenido_detalle">				
				<div class="tabla_detalle">
					<div id="contenedor_busqueda">
							<form class="formulario_busqueda">
								<?php include("select_mes1.php");?>		
								<input type="number" id="year1" value= 
								<?php include("select_year1.php");?>>

								<div class="buscar1">Buscar</div>
							</form>
					</div>	

					<div class="formulario_detalle">						
						<?php include("listado_boletas_busqueda.php");?>
					</div>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
	$(document).ready(function() {
	    $("form").keypress(function(e) {
	        if (e.which == 13) {
	            return false;
	        }
	    });
	    $(".contenedor_cargando").hide();
	    function changeColor(){
        if ($('#cargando').hasClass('uno')) {
            $('#cargando').removeClass('uno');
            $('#cargando').addClass('dos');           
        }
        else {
            $('cargando').removeClass('dos');
            $('#cargando').removeClass('dos');
            $('#cargando').addClass('uno');
            
        }
    }
    setInterval(changeColor, 700);
	});


	$("#emision").click(function () {
		$(".contenido_detalle").show();
		$(".contenido_gestion").hide();
		var mes1 = $('#mes1').val();
		var year1 = $('#year1').val();
		buscar_mes1(mes1,year1)
	});
	$("#gestion").click(function () {
		$(".contenido_gestion").show();
		$(".contenido_detalle").hide();
	});

	$(".buscar1").click(function () {
		$(".contenedor_cargando").show();
		var mes1 = $('#mes1').val();
		var year1 = $('#year1').val();
		buscar_mes1(mes1,year1)
		$(".contenedor_cargando").hide();
	});

	$("#buscar_numero_boleta").click(function () {
		var num_boleta_buscar = $("#numero_boleta").val();
		if(num_boleta_buscar!=""){
			buscar_boleta(num_boleta_buscar);	
		}else{
			alert("Debes ingresar número");
		}	
	});

	function buscar_mes1(m,y){
    	$.post("listado_boletas_busqueda.php",{mesBusqueda: m, yearBusqueda: y}, function(tablaListado){
            $(".formulario_detalle").html(tablaListado);            
        });	        		
	};
	function buscar_boleta(n){
		$.post("buscar_boletas.php",{numBoletaBusqueda: n}, function(boleta){
            $(".mostrar").html(boleta);                            
        });
        $("#contenedor_total").show();
		$(".contenedor_tabla1").show(); 
	}
	function buscar_boleta2(i,l,b,m,y){		
		$.post("buscar_boletas.php",{idBus: i, lecBus: l, bolBus: b, mesBus: m, yearBus: y}, function(boleta){
            $(".mostrar").html(boleta);                            
        });
        $("#contenedor_total").show();
		$(".contenedor_tabla1").show(); 
	}
	function crear_directorio(){	
		$.post("crear_directorio.php",{}, function(boleta){
        });        
	}
	function enviar_boleta(cCorreo,cNumeroBoleta,cNombre,cRut,cEmision,cVencimiento,cTotal){$.post("enviar_mail.php",{cCorreo:cCorreo,cNumeroBoleta:cNumeroBoleta,cNombre:cNombre,cRut:cRut,cEmision:cEmision,cVencimiento:cVencimiento,cTotal:cTotal}, function(boleta){
        });
	}
	function insertar_boleta(cNumeroBoleta,cMedidor,cEmision,cVencimiento,cLecActual,cLecAnterior,cValorKw,cConsumoKw,cConsumoDinero,cCargoFijo,cRut,cSaldoAnterior,cSaldoFavor,cCorteRep,cGastosOp,cIntereses,cTotal,cUltimoMonto,cUltimaFecha,cUltimoMetodo,cUltimoCodigo){$.post("insertar_boleta.php",{cNumeroBoleta:cNumeroBoleta,cMedidor:cMedidor,cEmision:cEmision,cVencimiento:cVencimiento,cLecActual:cLecActual,cLecAnterior:cLecAnterior,cValorKw:cValorKw,cConsumoKw:cConsumoKw,cConsumoDinero:cConsumoDinero,cCargoFijo:cCargoFijo,cRut:cRut,cSaldoAnterior:cSaldoAnterior,cSaldoFavor:cSaldoFavor,cCorteRep:cCorteRep,cGastosOp:cGastosOp,cIntereses:cIntereses,cTotal:cTotal,cUltimoMonto:cUltimoMonto,cUltimaFecha:cUltimaFecha,cUltimoMetodo:cUltimoMetodo,cUltimoCodigo:cUltimoCodigo}, function(boleta){
        });
	}
	function emitir_boleta(cNumeroBoleta,cRut,cNombre,cDireccion,cMedidor,cLecAnterior,cLecActual,cValorKw,cConsumoKw,cUltimaFecha,cEmision,cVencimiento,cCargoFijo,cConsumoDinero,cSaldoAnterior,cCorteRep,cIntereses,cSaldoFavor,cTotal){	
		$.post("TCPDF/examples/crear_boleta.php",{cNumeroBoleta: cNumeroBoleta, cRut: cRut, cNombre: cNombre, cDireccion: cDireccion, cMedidor: cMedidor, cLecAnterior: cLecAnterior, cLecActual: cLecActual, cValorKw: cValorKw, cConsumoKw: cConsumoKw, cEmision: cEmision, cUltimaFecha: cUltimaFecha, cVencimiento: cVencimiento, cCargoFijo: cCargoFijo, cConsumoDinero: cConsumoDinero, cSaldoAnterior: cSaldoAnterior, cCorteRep: cCorteRep, cIntereses: cIntereses, cSaldoFavor: cSaldoFavor, cTotal:cTotal}, function(){
			$("#numero_boleta").val(cNumeroBoleta);
			var fechaEmision = cEmision;
			var fechaArray = fechaEmision.split('-');
			var boletaMostrar = '<div class="contenedor_tabla2"><h2>Boleta n° '+cNumeroBoleta+'</h2><p>(Emisión: '+cEmision+')</p><div class="contenedor_thumb"><a href="archivo/'+fechaArray[2]+'/'+fechaArray[1]+'/'+cNumeroBoleta+'.pdf" target="_blank"><div class="boleta_mostrar"><img src="images/thumbnail.png"></div></a></div></div>';
            $(".mostrar").html(boletaMostrar);
            $(".contenedor_cargando").hide();                            
        });        
	}
	
</script>
</body>
</html>