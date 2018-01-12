<?
require("conexion.php");
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$rut = $_POST["rut"];
$dv = $_POST["dv"];
$passcode = $_POST["passcode"];
$credencial = $_POST["credencial"];
$email = $_POST["email"];
$fono = $_POST["fono"];

$consulta = "UPDATE cpanel SET nombre = '$nombre', apellido = '$apellido', dv = '$dv', passcode = '$passcode', credencial = '$credencial', email = '$email', fono = '$fono'  WHERE rut = '$rut'";
$mysqli->query($consulta);
$filasAfectadas = $mysqli->affected_rows;
if($filasAfectadas > 0){
	printf("Filas modificadas:\n".$filasAfectadas);
}else{
	printf("No se ha actualizado información");
}
?>