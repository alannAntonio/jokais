<?php
require('conexion.php');
$rutBusqueda = $_POST['rutBusqueda'];

$caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
$caracteres_buenos = array("& lt;", "& gt;", "& quot;", "& #x27;", "& #x2F;", "& #060;", "& #062;", "& #039;", "& #047;");
$rutBusqueda = str_replace($caracteres_malos, $caracteres_buenos, $rutBusqueda);

$mensaje = "";
$ultimo_pago = "";
$ultima_fecha = "";
$ultimo_metodo = "";
$ultimo_codigo = "";
if (isset($rutBusqueda)) {

	$consulta = "SELECT * FROM clientes	WHERE rut = '$rutBusqueda' ";
	$result = $mysqli->query($consulta);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$count = mysqli_num_rows($result);

	if ($count === 0) {
		$mensaje = "<h1>No existe N° Cliente ".$rutBusqueda."</h1>";
	} else {			

			$nombre = ucwords($row['nombre'].' '.$row['apellidopat'].' '.$row['apellidomat']);
			$deudaSim = $row['deuda'];
			$deuda = '$'.number_format($deudaSim, 0, "," ,"." );			
			$saldo_favor = $row['saldo_favor'];
			$direccion = ucwords($row['calle_nombre'].' '.$row['calle_numero']);

			$consulta = "SELECT * FROM pagos WHERE rut = '$rutBusqueda' order by fecha desc limit 1";
			$result = $mysqli->query($consulta);
			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
			$count = mysqli_num_rows($result);
			if ($count != 0) {
				$ultimo_pago = ' $'.$row["monto"];
				$ultima_fecha = $row["fecha"];
				$ultimo_metodo = $row["metodo"];
				$ultimo_codigo = $row["codigo"];
			};

			if($deudaSim > 0){
				$linea_deuda = '<h3>Deuda: '.$deuda.'</h3>';
			}else{
				$linea_deuda = '<h4>Deuda: '.$deuda.'</h4>';
			};
			
			$mensaje = '				
					<h1>'.$nombre.'</h1>
					<h2>Dirección: '.$direccion.'</h2>
					<h2>Último pago:'.$ultimo_pago.'</h2>
					<h2>Fecha:'.$ultima_fecha.'</h2>
					<h2>Método:'.ucwords($ultimo_metodo).'</h2>
					<h2>Código:'.$ultimo_codigo.'</h2>'.$linea_deuda.'
					<h2>(Saldo a favor $'.number_format($saldo_favor, 0, "," ,"." ).')</h2>'
					
			;		
			
	}; 

};
echo $mensaje;
?>