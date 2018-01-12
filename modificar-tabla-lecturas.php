<?
require("conexion.php");
$id = $_POST["id"];
$medidor = $_POST["medidor"];
$fecha = $_POST["fecha"];
$kw = $_POST["kw"];

$consulta = "UPDATE lecturas SET fecha = '$fecha', kw = '$kw' WHERE id = '$id'";
$mysqli->query($consulta);
$filasAfectadas = $mysqli->affected_rows;
if($filasAfectadas > 0){
	printf("Filas modificadas:\n".$filasAfectadas);
}else{
	printf("No se ha actualizado información");
}
?>