<?php
//Archivo de conexión a la base de datos
require('conexion.php');
date_default_timezone_set("America/Santiago");

//Variable de búsqueda
$consultaIngresar = $_POST['valorIngresar'];
$consultaLectura = $_POST['valorLectura'];

//Filtro anti-XSS
$caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
$caracteres_buenos = array("& lt;", "& gt;", "& quot;", "& #x27;", "& #x2F;", "& #060;", "& #062;", "& #039;", "& #047;");
$consultaIngresar = str_replace($caracteres_malos, $caracteres_buenos, $consultaIngresar);

//Variable vacía (para evitar los E_NOTICE)
$mensaje = "";
$hoy = date("Y-m-d");//<------------------------- cambiar!!!
$hoy2 = date("d-m-Y");

//Comprueba si $consultaBusqueda está seteado
if (isset($consultaIngresar)) {
	$consulta = "SELECT * FROM clientes	WHERE medidor = '$consultaIngresar' ";
	$result = $mysqli->query($consulta);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$count = mysqli_num_rows($result);
	if ($count === 0) {
		$mensaje = '	
			<table>								
				<tr>
					<td>Estado</td>
					<td>:</td>
					<td>No ingresado</td>
				</tr>
			</table>
		';
	}else{
		$consulta = "INSERT INTO lecturas VALUES ('', '$consultaIngresar', '$hoy', '$consultaLectura')";	
		$mysqli->query($consulta);
		$count = $mysqli->affected_rows;
		
		$mensaje = '	
			<table>								
				<tr>
					<td>Estado</td>
					<td>:</td>
					<td>Ingresado ('.$hoy2.')</td>
				</tr>
			</table>
		';
	}
	

	
	

};//Fin isset $consultaBusqueda

//Devolvemos el mensaje que tomará jQuery
echo $mensaje;
?>