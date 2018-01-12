<?
require("conexion.php");
date_default_timezone_set("America/Santiago");
$ahora = date("Y-m-d h:i:s");
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

$consulta_rescatar_original = "SELECT * FROM clientes WHERE medidor = '$medidor' limit 1";
$result = $mysqli->query($consulta_rescatar_original);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

$nombreOrig = $row["nombre"]." & ".$nombre;
$apellidoPatOrig = $row["apellidopat"]." & ".$apellidoPat;
$apellidoMatOrig = $row["apellidomat"]." & ".$apellidoMat;
$rutOrig = $row["rut"]." & ".$rut;
$dvOrig = $row["dv"]." & ".$dv;
$pseudonimoOrig = $row["pseudonimo"]." & ".$pseudonimo;
$calleNombreOrig = $row["calle_nombre"]." & ".$calleNombre;
$calleNumeroOrig = $row["calle_numero"]." & ".$calleNumero;
$fonoOrig = $row["fono"]." & ".$fono;
$correoOrig = $row["correo"]." & ".$correo;
$incorporacionOrig = $row["fecha_incorporacion"]." & ".$incorporacion;
$deudaOrig = $row["deuda"]." & ".$deuda;
$saldoFavorOrig = $row["saldo_favor"]." & ".$saldoFavor;
$passwordOrig = $row["passcode"]." & ".$password;
$credencialOrig = $row["credencial"]." & ".$credencial;
$modPassOrig = $row["modificacion_password"]." & ".$modPass;

$consulta_respaldar_original = "INSERT INTO clientes_respaldo (nombre,apellidopat,apellidomat,rut,dv,pseudonimo,calle_nombre,calle_numero,fono,correo,medidor,fecha_incorporacion,deuda,saldo_favor,passcode,credencial,modificacion_password,fecha_suceso) VALUES ('$nombreOrig','$apellidoPatOrig','$apellidoMatOrig','$rutOrig','$dvOrig','$pseudonimoOrig','$calleNombreOrig','$calleNumeroOrig','$fonoOrig','$correoOrig','$medidor','$incorporacionOrig','$deudaOrig','$saldoFavorOrig','$passwordOrig','$credencialOrig','$modPassOrig','$ahora')";
$mysqli->query($consulta_respaldar_original);

$consulta = "UPDATE clientes SET nombre = '$nombre', apellidopat = '$apellidoPat', apellidomat = '$apellidoMat', rut = '$rut', dv = '$dv', pseudonimo = '$pseudonimo', calle_nombre = '$calleNombre', calle_numero = '$calleNumero', fono = '$fono', correo = '$correo', fecha_incorporacion = '$incorporacion', deuda = '$deuda', saldo_favor = '$saldoFavor', passcode = '$password', credencial = '$credencial', modificacion_password = '$modPass'  WHERE medidor = '$medidor'";
$mysqli->query($consulta);
$filasAfectadas = $mysqli->affected_rows;
if($filasAfectadas > 0){
	printf("Filas modificadas:\n".$filasAfectadas);
}else{
	printf("No se ha actualizado información");
}
?>