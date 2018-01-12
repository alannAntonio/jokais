<?
require("conexion.php");
$fechaEmision = $_POST["fechaEmision"];
$fechaVencimiento = $_POST["fechaVencimiento"];
$numeroBoleta = $_POST["numBoleta"];
$lecturaActual = $_POST["lecturaActual"];

$consulta = "UPDATE boletas SET lectura_actual = '$lecturaActual', fecha_emision = '$fechaEmision', fecha_vencimiento = '$fechaVencimiento' WHERE numero_boleta = '$numeroBoleta'";
$mysqli->query($consulta);
$filasAfectadas = $mysqli->affected_rows;
if($filasAfectadas > 0){
	printf("Filas modificadas:\n".$filasAfectadas);
}else{
	printf("No se ha actualizado información");
}
?>