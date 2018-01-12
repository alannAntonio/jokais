<?php
$fecha_hoy = date("d-m-Y");
$fecha_hoy = explode("-", $fecha_hoy);
if($fecha_hoy[0] >= 28 || $fecha_hoy[0] <= 10){ // debe ir de 0 a 10
	echo '<div id="ingresar" class="boton">Ingresar</div>';
}else{
	echo '<div id="no_ingresar" class="boton">No Ingresar</div>';
}
?>