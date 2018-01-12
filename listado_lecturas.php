<?php
include("conexion.php");
date_default_timezone_set("America/Santiago");
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
    	$q++;
    	$q++;
    	$cliente[$i][$q] = ucwords($fila[7].' '.$fila[8]);	// 4 direccion    	    	
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
		$ultima_lectura = "<div class='pendiente'>Pendiente</div>";
	}else{		
		$hoy = date("d/m/Y");		
		$dia = explode("/", $hoy);

		if($dia[0]<28){
			if($dia[1]<2){
				$fecha1 = ($dia[2]-1)."/12/28";
			}
			$fecha1 = $dia[2]."/".($dia[1]-1)."/28";
			$fecha2 = $dia[2]."/".$dia[1]."/16";					
		}else{
			$fecha1 = $dia[2]."/".($dia[1])."/28";
			$fecha2 = date("Y/m/d");			
		}
		$consulta = "SELECT fecha FROM lecturas	WHERE medidor = '$lectura' AND fecha BETWEEN '$fecha1' AND '$fecha2' order by fecha desc limit 1";
		$result = $mysqli->query($consulta);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$count = mysqli_num_rows($result);
		if ($count == 0) {
			$ultima_lectura = "<div class='pendiente'>Pendiente</div>";
		}else{
			$ultima_lectura = "<div class='ingresada'>Ingresada</div>";
		}
	}
	$cliente[$p][3] = $ultima_lectura;	
}
//fin estado lectura

$hoy = date("d-m-Y");
$fechArr = explode("-",$hoy);
$mes = $fechArr[1];
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$mes_actual = $meses[($mes-1)];
$year_actual = $fechArr[2];

echo'
	<table cellspacing="0px">			
		<tr>
			<th width="20%"><strong>Cliente</strong></th>
			<th width="20%"><strong>Medidor</strong></th>
			<th width="25%"><strong>Dirección</strong></th>
			<th width="25%"><strong>Lectura</strong></th>
		</tr>
';

$cont = 1;
for($p = 0; $p < $total_clientes; $p++){
	
	if($cont%2==0){ 	
        $clase = "blanco";
    }else{
    	$clase = "verde";
    }
    $cont++;

echo'
		<tr class="'.$clase.' linea" id="'.$cliente[$p][2].'">
			<td>'.$cliente[$p][0].'</td>
			<td>'.$cliente[$p][2].'</td>
			<td>'.$cliente[$p][4].'</td>
			<td>'.$cliente[$p][3].'</td>				
		</tr>
';
}
echo'</table>';
echo'
	<script>
	$(".linea").click(function () {
			$("#formulario_lectura").show();
			$("#listado_lectura").hide();
			oID = $(this).attr("id");
			$("#busqueda").val(oID);
			buscar();
		});
	</script>
';
$mysqli->close();
?>