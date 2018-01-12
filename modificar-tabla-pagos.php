<?
require("conexion.php");
$codigo = $_POST["codigo"];
$rut = $_POST["rut"];
$monto = $_POST["monto"];
$metodo = $_POST["metodo"];
$fecha = $_POST["fecha"];

$consulta = "UPDATE pagos SET rut = '$rut', monto = '$monto', metodo = '$metodo', fecha = '$fecha' WHERE codigo = '$codigo'";
$mysqli->query($consulta);
$filasAfectadas = $mysqli->affected_rows;
if($filasAfectadas > 0){
	printf("Filas modificadas:\n".$filasAfectadas);
}else{
	printf("No se ha actualizado información");
}
?>