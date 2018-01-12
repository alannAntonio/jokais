<?
require("conexion.php");
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$rut = $_POST["rut"];
$dv = $_POST["dv"];
$password = $_POST["password"];
$credencial = $_POST["credencial"];
$email = $_POST["email"];
$fono = $_POST["fono"];

$consulta = "INSERT INTO cpanel (nombre,apellido,rut,dv,passcode,credencial,email,fono) VALUES ('$nombre','$apellido','$rut','$dv','$password','$credencial','$email','$fono')";

$mysqli->query($consulta);
$filasAfectadas = $mysqli->affected_rows;
if($filasAfectadas > 0){
	printf("Colaborador ".$nombre." ingresado con éxito");
}else{
	printf("¡No se ha ingresado Colaborador!");
}
?>