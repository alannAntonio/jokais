<?php
$consulta = "SELECT * FROM clientes ORDER BY nombre asc";
$result = $mysqli->query($consulta);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$count = mysqli_num_rows($result);

$cliente = array('');
$i = 0;
$q = 0;
$p = 0;
$total_clientes = 0;
if ($result = $mysqli->query($consulta)) {
	$i = 0;
    while ($fila = $result->fetch_row()) {
    	$total_clientes++;
    	$q = 0; 
    	$cliente[$i][$q] = ucwords($fila[1].' '.$fila[2]);//0 nombre y apellidos
    	$q++;
    	$cliente[$i][$q] = $fila[4]; // 1 rut
    	$q++;
    	$cliente[$i][$q] = $fila[11];	// 2 medidor    	    	
    	$i++;
    };
    
    $result->close();
}

$q = 0;
//consultando estado lectura
for($p = 0; $p < $total_clientes; $p++){
	$lectura = $cliente[$p][2];
	$consulta = "SELECT fecha FROM lecturas	WHERE medidor = '$lectura' order by fecha desc limit 1";
	$result = $mysqli->query($consulta);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$count = mysqli_num_rows($result);

	if ($count === 0) {
		$ultima_lectura = "<p class='pendiente'>Pendiente</p>";
	}else{		
		$hoy = date("d/m/Y");		
		$dia = explode("/", $hoy);

		if($dia[0]<28){
			if($dia[1]<2){
				$fecha1 = ($dia[2]-1)."/12/28";
			}
			$fecha1 = $dia[2]."/".($dia[1]-1)."/28";
			$fecha2 = $dia[2]."/".$dia[1]."/12";					
		}else{
			$fecha1 = $dia[2]."/".($dia[1])."/28";
			$fecha2 = date("Y/m/d");			
		}
		$consulta = "SELECT fecha FROM lecturas	WHERE medidor = '$lectura' AND fecha BETWEEN '$fecha1' AND '$fecha2' order by fecha desc limit 1";
		$result = $mysqli->query($consulta);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$count = mysqli_num_rows($result);
		if ($count === 0) {
			$ultima_lectura = "<p class='pendiente'>Pendiente</p>";
		}else{
			$ultima_lectura = "<p class='ingresada'>Ingresada</p>";
		}
	}
	$cliente[$p][3] = $ultima_lectura;	
}
//fin estado lectura

//consultando estado boleta
for($p = 0; $p < $total_clientes; $p++){
	$cliente_rut = $cliente[$p][1];
	$hoy = date("d/m/Y");		
	$dia = explode("/", $hoy);
	$fecha1 = $dia[2]."/".($dia[1])."/7";
	$fecha2 = $dia[2]."/".($dia[1])."/20";			
	$consulta = "SELECT fecha_emision FROM boletas WHERE cliente = '$cliente_rut'  AND fecha_emision BETWEEN '$fecha1' AND '$fecha2' order by fecha_emision desc limit 1";
	$result = $mysqli->query($consulta);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$count = mysqli_num_rows($result);

	if ($count === 0) {
		$ultima_emision = "<p class='pendiente'>Pendiente</p>";
	}else{
		$ultima_emision = "<p class='ingresada'>Emitida</p>";		
	}
	$cliente[$p][4] = $ultima_emision;
}
//fin estado boleta

$hoy = date("d-m-Y");
$fechArr = explode("-",$hoy);
$mes = $fechArr[1];
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$mes_actual = $meses[($mes-1)];
$year_actual = $fechArr[2];

echo'
	<div class="resultados" id="'.$mes_actual.'-'.$year_actual.'">Resultados de '.$mes_actual.'-'.$year_actual.'</div>
	<table id="tabla_detalle" cellspacing="0px" cellpadding="6px">			
		<tr>
			<td width="30%"><strong>Cliente</strong></td>
			<td width="20%"><strong>Medidor</strong></td>
			<td width="25%"><strong>Lectura</strong></td>
			<td width="25%"><strong>Boleta</strong></td>
		</tr>
';

$cont = 1;
for($p = 0; $p < $total_clientes; $p++){
	
	if($cont%2==0){ 	
        $clase = "blanco";
    }else{
    	$clase = "morado";
    }
    $cont++;

echo'
		<tr class="'.$clase.' linea" id="'.$cliente[$p][1].'">
			<td>'.$cliente[$p][0].'</td>
			<td>'.$cliente[$p][2].'</td>
			<td>'.$cliente[$p][3].'</td>
			<td>'.$cliente[$p][4].'</td>				
		</tr>
';
}
echo'</table>';
echo'
	<script>
	$(".linea").click(function () {
			$(".contenido_gestion").show();
			$(".contenido_detalle").hide();
			oID = $(this).attr("id");
			var ch = $(this).children("td");
			var lectura = $(ch[2]).children("p").html();
			var boleta = $(ch[3]).children("p").html();
			var mes = "'.$mes_actual.'";
			var year = "'.$year_actual.'";
			buscar_boleta2(oID,lectura,boleta,mes,year);
		});
	</script>
';
$mysqli->close();
?>