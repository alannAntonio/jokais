<?php
//Archivo de conexión a la base de datos
require('conexion.php');
date_default_timezone_set("America/Santiago");
//Variable de búsqueda
$clienteIngresar = $_POST['clienteIngresar'];
$montoIngresar = $_POST['montoIngresar'];
$metodoIngresar = $_POST['metodoIngresar'];
$hoyJd = explode(",", date("m,d,Y"));
$jd = GregorianToJD($hoyJd[0],$hoyJd[1],$hoyJd[2]);
$mensaje = "";
$hoy = date("Y-m-d H:i:s");
$codigo = "";

$consulta = "SELECT * FROM pagos WHERE rut = '$clienteIngresar' order by id desc limit 1 ";
$result = $mysqli->query($consulta);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$count = mysqli_num_rows($result);

if ($count != 0) {
	$id = ($row['id'])+1;
	$codigo = $jd.$id.$clienteIngresar;
}else{
	$id = 1;
	$codigo = $jd.$id.$clienteIngresar;
};

if (isset($montoIngresar)) {

	$consulta = "SELECT * FROM clientes WHERE rut = '$clienteIngresar'";
	$result = $mysqli->query($consulta);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$count = mysqli_num_rows($result);

	if ($count != 0){

		$deuda = $row['deuda'];
		$saldo_favor = $row['saldo_favor'];
	

		if($deuda== "0" && $saldo_favor== "0"){
			$consulta = "UPDATE clientes SET saldo_favor = '$montoIngresar' WHERE rut = '$clienteIngresar'";
			$mysqli->query($consulta);
		};

		if($deuda != "0"){
			if($deuda>=$montoIngresar){
				$actualizar_deuda = $deuda-$montoIngresar;
				$consulta = "UPDATE clientes SET deuda = '$actualizar_deuda' WHERE rut = '$clienteIngresar'";
				$mysqli->query($consulta);
			}else{
				$actualizar_deuda = $montoIngresar-$deuda;
				$consulta = "UPDATE clientes SET deuda = '0', saldo_favor = $actualizar_deuda WHERE rut = '$clienteIngresar'";
				$mysqli->query($consulta);
			};
		};

		if($saldo_favor != "0"){
			$actualizar_deuda = $saldo_favor+$montoIngresar;
			$consulta = "UPDATE clientes SET deuda = '0', saldo_favor = $actualizar_deuda WHERE rut = '$clienteIngresar'";
			$mysqli->query($consulta);
		};



		$consulta = "INSERT INTO pagos VALUES ('$id', '$codigo', '$clienteIngresar', '$montoIngresar','$metodoIngresar','$hoy')";
		$mysqli->query($consulta);
		

		
		$mensaje = '
		
						<h1>Pago Ingresado!</h1>
						<h1>Monto: $'.number_format($montoIngresar, 0, "," ,"." ).'</h1>
						<h2>Fecha:'.$hoy.'</h2>
						<h2>Método:'.ucwords($metodoIngresar).'</h2>
						<h2>Código:'.$codigo.'</h2>

		';
	}else{
		$mensaje = '<h1>Debe cargar un cliente existente</h1>';
	};
};//Fin isset $consultaBusqueda

//Devolvemos el mensaje que tomará jQuery
echo $mensaje;
?>