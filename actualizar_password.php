<?php
include("conexion.php");
$pass1 = $_POST["pass1"];
$username = $_POST["username"];


$consulta = "UPDATE clientes SET passcode ='$pass1', modificacion_password = '1' WHERE rut = '$username'";
	$mysqli->query($consulta);
	@session_start();
	session_destroy();
	echo "<h1>¡Clave actualizada exitosamente!</h1><br><br><p>Porfavor, vuelve a ingresar.</p>";
?>