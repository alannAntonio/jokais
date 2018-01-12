<?
require("conexion.php");
$nombreLlave = $_POST['nombreLlave'];
$contenidoLlave = $_POST['contenidoLlave'];
$tabla = $_POST['tablaLlave'];
$consulta = "DELETE FROM $tabla WHERE $nombreLlave = $contenidoLlave";
$mysqli->query($consulta);
$filasAfectadas = $mysqli->affected_rows;
if($filasAfectadas > 0){
	echo("<div id='x-eliminar' onclick='ocultarEliminarShow();'>Cerrar[x]</div>Filas eliminadas:\n".$filasAfectadas);
}else{
	echo("<div id='x-eliminar' onclick='ocultarEliminarShow();'>Cerrar[x]</div>¡No se ha eliminado registro!".$nombreLlave.$contenidoLlave.$tabla);
}
?>