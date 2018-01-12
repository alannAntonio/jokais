<?
require("conexion.php");
$nombre = $_POST["nombre"];
$apellidoPat = $_POST["apellidoPat"];
$apellidoMat = $_POST["apellidoMat"];
$rut = $_POST["rut"];
$dv = $_POST["dv"];
$pseudonimo = $_POST["pseudonimo"];
$calleNombre = $_POST["calleNombre"];
$calleNumero = $_POST["calleNumero"];
$fono = $_POST["fono"];
$correo = $_POST["correo"];
$medidor = $_POST["medidor"];
$incorporacion = $_POST["incorporacion"];
$deuda = $_POST["deuda"];
$password = $_POST["password"];
$credencial = $_POST["credencial"];
$modPass = $_POST["modPass"];
$saldoFavor = $_POST["saldoFavor"];

$consulta = "INSERT INTO clientes (nombre,apellidopat,apellidomat,rut,dv,pseudonimo,calle_nombre,calle_numero,fono,correo,medidor,fecha_incorporacion,deuda,saldo_favor,passcode,credencial,modificacion_password) VALUES ('$nombre','$apellidoPat','$apellidoMat','$rut','$dv','$pseudonimo','$calleNombre','$calleNumero','$fono','$correo','$medidor','$incorporacion','$deuda','$saldoFavor','$password','$credencial','$modPass')";

$mysqli->query($consulta);
$filasAfectadas = $mysqli->affected_rows;
if($filasAfectadas > 0){
	printf("Cliente ".$nombre." ingresado con éxito");
}else{
	printf("¡No se ha ingresado cliente!");
}
?>