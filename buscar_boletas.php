<?php
include("conexion.php");
date_default_timezone_set("America/Santiago");
if(isset($_POST["numBoletaBusqueda"])){	
	$boletaBuscar = $_POST["numBoletaBusqueda"];
	$consulta = "SELECT * FROM boletas	WHERE numero_boleta = '$boletaBuscar' ";
	$result = $mysqli->query($consulta);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$count = mysqli_num_rows($result);
	if ($count === 0) {
		echo '
		<div class="contenedor_tabla2"><h1>No existe boleta n° 
			'.$boletaBuscar.'<h1>			
		</div>
		';
	}else{

		$fecha = $row["fecha_emision"];
		$f = explode("-",$fecha);
		echo'
			<div class="contenedor_tabla2">
				<h2>Boleta n° '.$boletaBuscar.'</h2>
					<p>(Emisión: '.$f[2].'/'.$f[1].'/'.$f[0].')</p>
				<div class="contenedor_thumb">
					
					<a href="archivo/'.$f[0].'/'.$f[1].'/'.$boletaBuscar.'.pdf" target="_blank">
						<div class="boleta_mostrar">
							<img src="images/thumbnail.png">
						</div>
					</a>
				</div>	
			</div>
		';
	}
	
}elseif(isset($_POST["idBus"])){
	$idBus =  $_POST["idBus"];
	$lecBus = $_POST["lecBus"];
	$bolBus = $_POST["bolBus"];
	$mesBus = $_POST["mesBus"];
	$yearBus = $_POST["yearBus"];

	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	for($m = 0; $m<=11; $m++){
		if($meses[$m]==$mesBus){
			$mes = $m+1;
		}
	}

	if($lecBus == "Pendiente"){
		echo '<div class="contenedor_tabla2"><h1>Boleta con lectura pendiente. Actualizar lectura.</h1></div>';
	}elseif($lecBus == "Ingresada" && $bolBus == "Emitida"){
		
		$mes2 = $mes+1;
		$fecha1 = $yearBus."/".$mes."/"."1";
		$fecha2 = $yearBus."/".$mes2."/"."1";		
		$consulta = "SELECT * FROM boletas	WHERE cliente = '$idBus' AND fecha_emision BETWEEN '$fecha1' AND '$fecha2' ORDER BY fecha_emision desc limit 1";
		$result = $mysqli->query($consulta);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$count = mysqli_num_rows($result);
		if ($count === 0) {
			echo '<div class="contenedor_tabla2"><h2>Error, no se pudo obtener boleta entre '.$fecha1.' y '.$fecha2.'</h2></div>';
		}else{
			if($mes<10){
				$mes = "0".$mes;
			}
			echo'
				<div class="contenedor_tabla2">
					<h2>Boleta n° '.$row["numero_boleta"].'</h2>
						<p>(Emisión: '.$row["fecha_emision"].')</p>
					<div class="contenedor_thumb">
						
						<a href="archivo/'.$yearBus.'/'.$mes.'/'.$row["numero_boleta"].'.pdf" target="_blank">
							<div class="boleta_mostrar">
								<img src="images/thumbnail.png">
							</div>
						</a>
					</div>	
				</div>
			';
		}
	}elseif($lecBus == "Ingresada" && ($bolBus == "Pendiente" || $bolBus == "No emitida")){		
		$consulta = "SELECT * FROM clientes	WHERE rut = '$idBus'";
		$result = $mysqli->query($consulta);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$count = mysqli_num_rows($result);

		if ($count > 0) {

			$clienteNombre = $row["nombre"]." ".$row["apellidopat"]." ".$row["apellidomat"];
			$clienteNombre = ucwords($clienteNombre);
			$clienteMedidor = $row["medidor"];
			$clienteDireccion = $row["calle_nombre"]." ".$row["calle_numero"];
			$clienteDeuda = $row["deuda"];
			$clienteDeuda = $clienteDeuda + 0;
			$clienteSaldoFavor = $row["saldo_favor"];
			$clienteSaldoFavor = $clienteSaldoFavor + 0;
			$clienteCargoFijo = 1800;
			$clienteCorreo = $row["correo"];
		}
		
		$codigo = "";

		$consulta = "SELECT * FROM boletas WHERE cliente = '$idBus' order by id desc limit 1 ";
		$result = $mysqli->query($consulta);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$count = mysqli_num_rows($result);
		if ($count != 0) {
			$id = ($row['id'])+1;
			if($id<10){
				$id = "000".$id;
			}elseif($id>9 && $id<100){
				$id = "00".$id;
			}elseif($id>99 && $id<1000){
				$id = "0".$id;
			}elseif($id>999){
				$id = $id;
			}
		}else{
			$id = "0001";
		}
		$clienteNumeroBoleta = $idBus.$id;
		$clienteRut = $idBus;

		$consulta = "SELECT * FROM pagos WHERE rut = '$idBus' ORDER BY fecha desc limit 1";
		$result = $mysqli->query($consulta);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$count = mysqli_num_rows($result);		
		if ($count > 0){
			$clienteUltimoMonto = $row["monto"];
			$clienteUltimaFecha = $row["fecha"];
			$clienteUltimaFecha = new DateTime($clienteUltimaFecha);
			$clienteUltimaFecha = $clienteUltimaFecha->format('d-m-Y');
			$clienteUltimoMetodo = $row["metodo"];
			$clienteUltimoCodigo = $row["codigo"];						
		}else{
			$clienteUltimoMonto = "";
			$clienteUltimaFecha = "";			
			$clienteUltimoMetodo = "";
			$clienteUltimoCodigo = "";					
		}
		$hoy = date("d-m-Y");
		$clienteVencimiento = explode("-", $hoy);
		$clienteVencimiento = "23-".$clienteVencimiento[1]."-".$clienteVencimiento[2];

		$consulta = "SELECT * FROM lecturas WHERE medidor = '$clienteMedidor' ORDER BY fecha desc limit 1";
		$result = $mysqli->query($consulta);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$count = mysqli_num_rows($result);
		if ($count > 0){
			$clienteLecturaActual = $row["kw"];
			$clienteFechaLectura = $row["fecha"];

		}else{
			$clienteFechaLectura = "No";
		}
		$consulta = "SELECT * FROM lecturas WHERE medidor = '$clienteMedidor' AND fecha < '$clienteFechaLectura' ORDER BY fecha desc limit 1";
		$result = $mysqli->query($consulta);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$count = mysqli_num_rows($result);
		if ($count > 0){
			$clienteLecturaAnterior = $row["kw"];
		}else{
			$clienteLecturaAnterior = "0";	
		}
		$clientePrecioKw = "165";
		$clienteConsumoKw = $clienteLecturaActual-$clienteLecturaAnterior+0;
		$clienteConsumoDinero = $clienteConsumoKw * $clientePrecioKw + 0;
		$clienteGastosOperacionales = "0";
		$clienteCorteReposicion = "0";
		$clienteIntereses = "0";

		$clienteTotalDeudas = $clienteConsumoDinero+$clienteCargoFijo+$clienteDeuda+$clienteGastosOperacionales+$clienteCorteReposicion+$clienteIntereses;
		$clienteDescuento = "0";
		$clienteTotalDescuentos = $clienteSaldoFavor;

		$clienteTotalBoleta = $clienteTotalDeudas-$clienteTotalDescuentos;

		if($clienteCorreo == "null"){
			$clienteCorreo = "";
			echo'<div class="aviso_correo">
				<strong>Importante: </strong><p>Cliente no registra correo.</p><p>Enviar boleta por otro medio.</p>
			</div>';
		}
		echo'
			
			<div class="contenedor_tabla2">
				<h1>'.$clienteNombre.'</h1>
				<p>Medidor: '.$clienteMedidor.'</p>
				<p>Dirección: '.$clienteDireccion.'</p>
				<p>Último pago: $'.$clienteUltimoMonto.'</p>
				<p>Fecha: '.$clienteUltimaFecha.'</p>
				<p>Método: '.$clienteUltimoMetodo.'</p>
				<p>Código: '.$clienteUltimoCodigo.'</p>
			</div>

			<div class="contenedor_tabla1" id="contenedor_deuda">
				<div class="form_contenido">
					<p>Datos para emisión de boletas</p>
					<div id="cabeceras">Deuda</div>
					<div id="cabeceras">
						<table cellspacing="0px" cellpadding="5px">
							<tr>
								<th width="40%">Item</th>
								<th></th>
								<th width="50%">Valor</th>
							</tr>									
							<tr>
								<td>Lectura anterior</td>
								<td>:</td>
								<td>'.$clienteLecturaAnterior.'</td>
							</tr>
							<tr>
								<td>Lectura actual</td>
								<td>:</td>
								<td>'.$clienteLecturaActual.'</td>
							</tr>
							<tr>
								<td>Consumo(Kw)</td>
								<td>:</td>
								<td>'.$clienteConsumoKw.'</td>
							</tr>
							<tr>
								<td>Consumo($)</td>
								<td>:</td>
								<td>'.$clienteConsumoDinero.'</td>
							</tr>
							<tr>
								<td>Cargo Fijo</td>
								<td>:</td>
								<td>'.$clienteCargoFijo.'</td>
							</tr>									
							<tr>
								<td>Deuda</td>
								<td>:</td>
								<td>'.$clienteDeuda.'</td>
							</tr>
							<tr>
								<td>Gastos Operacionales</td>
								<td>:</td>
								<td><input class="editables" id="gastos_op" type="number" name="descuentos" value="'.$clienteGastosOperacionales.'"></td>
							</tr>								
							<tr>
								<td>Corte/Reposición</td>
								<td>:</td>
								<td><input class="editables" id="corte_rep" type="number" name="descuentos" value="'.$clienteCorteReposicion.'"></td>
							</tr>								
							<tr>
								<td>Intereses</td>
								<td>:</td>
								<td>'.$clienteIntereses.'</td>
							</tr>								
							<tr class="total_fijos">
								<td>Total</td>
								<td></td>
								<td><input class="editables" id="total_fijos" type="text" name="descuentos" value="'.$clienteTotalDeudas.'" disabled></td>
							</tr>							
						</table>							
					</div>
					
				
				</div>
			</div>

			<div class="contenedor_tabla1" id="contenedor_descuentos">
				<div class="form_contenido">
					<p>Datos para emisión de boletas</p>
					<div id="cabeceras">Descuentos</div>
					<div id="cabeceras">
						<table cellspacing="0px" cellpadding="5px">
							<tr>
								<th width="40%">Item</th>
								<th></th>
								<th width="50%">Valor</th>
							</tr>
							<tr>
								<td>Saldo a favor</td>
								<td>:</td>
								<td>$'.$clienteSaldoFavor.'</td>
							</tr>									
							<tr>
								<td>Descuentos</td>
								<td>:</td>
								<td><input class="editables" id="descuentos" type="number" name="descuentos" value="'.$clienteDescuento.'"></td>
							</tr>											
							<tr class="total_fijos">
								<td>Total</td>
								<td></td>
								<td><input class="editables" id="total_descuentos" type="text" name="descuentos" value="'.$clienteTotalDescuentos.'" disabled></td>
							</tr>							
						</table>							
					</div>											
				</div>
			</div>

			<script>
				$("#emitir_boleta").click(function () {
					$(".contenedor_cargando").show();
					var cNumeroBoleta = "'.$clienteNumeroBoleta.'";
					var cRut = "'.$clienteRut.'";
					var cNombre = "'.$clienteNombre.'";
					var cDireccion = "'.$clienteDireccion.'";
					var cMedidor = "'.$clienteMedidor.'";
					var cLecAnterior = "'.$clienteLecturaAnterior.'";
					var cLecActual = "'.$clienteLecturaActual.'";
					var cValorKw = "'.$clientePrecioKw.'";
					var cConsumoKw = "'.$clienteConsumoKw.'";
					var cUltimaFecha = "'.$clienteUltimaFecha.'";
					var cUltimoMonto = "'.$clienteUltimoMonto.'";
					var cUltimoMetodo = "'.$clienteUltimoMetodo.'";
					var cUltimoCodigo = "'.$clienteUltimoCodigo.'";
					var cEmision = "'.$hoy.'";
					var cVencimiento = "'.$clienteVencimiento.'";
					var cCargoFijo = "'.$clienteCargoFijo.'";
					var cCorreo = "'.$clienteCorreo.'";
					var cConsumoDinero = "'.$clienteConsumoDinero.'";
					var cSaldoAnterior = "'.$clienteDeuda.'";
					var cCorteRep = "'.$clienteCorteReposicion.'";
					var cGastosOp = "'.$clienteGastosOperacionales.'";
					var cIntereses = "'.$clienteIntereses.'";
					var cSaldoFavor = "'.$clienteSaldoFavor.'";
					var cTotal = "'.$clienteTotalBoleta.'";

					crear_directorio();					

					emitir_boleta(cNumeroBoleta,cRut,cNombre,cDireccion,cMedidor,cLecAnterior,cLecActual,cValorKw,cConsumoKw,cUltimaFecha,cEmision,cVencimiento,cCargoFijo,cConsumoDinero,cSaldoAnterior,cCorteRep,cIntereses,cSaldoFavor,cTotal);

					insertar_boleta(cNumeroBoleta,cMedidor,cEmision,cVencimiento,cLecActual,cLecAnterior,cValorKw,cConsumoKw,cConsumoDinero,cCargoFijo,cRut,cSaldoAnterior,cSaldoFavor,cCorteRep,cGastosOp,cIntereses,cTotal,cUltimoMonto,cUltimaFecha,cUltimoMetodo,cUltimoCodigo);

					enviar_boleta(cCorreo,cNumeroBoleta,cNombre,cRut,cEmision,cVencimiento,cTotal);
				});

				
			</script>
	

			<div class="contenedor_tabla2" id="contenedor_total">
				<h1>Total</h1>
				<input type="text" class="input_gde" id="total_boleta" disabled="" value="'.$clienteTotalBoleta.'">

			';
		
		$fechames = explode("-", $hoy);	
		$fechames =	$fechames[1];
		$fechadia = explode("-", $hoy);	
		

		if($mes == $fechames){
			if($fechadia[0] >= 7 && $fechadia[0] <= 20){
				if($clienteCorreo == ""){
				echo '<div class="btn_buscar2" id="emitir_boleta">Emitir sin enviar</div>
				</div>';
				}else{
					echo'<div class="btn_buscar" id="emitir_boleta">Emitir y Enviar</div><p>Se enviará a '.$clienteCorreo.'</p>
					</div>';
				}
			}else{
				echo '<h2>La fecha de emisión es entre el día 9 y el día 20 de cada mes.</h2>
				</div>';
			}		
		}else{
			echo '<h2>Imposible emitir boleta anterior</h2>
				</div>';
		}							
	}
}
?>