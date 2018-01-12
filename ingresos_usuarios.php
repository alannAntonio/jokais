<?php
function ingresar_usuario($username,$credencial){
	include("conexion.php");
	include("get_real_ip.php");
	date_default_timezone_set("America/Santiago");
	$ip = realIp();
	$fecha = date("Y-m-d H-i-s");
	$consulta = "INSERT INTO ingresos VALUES ('', '$username', '$credencial', '$fecha', '$ip')";	
	$mysqli->query($consulta);
}
?>