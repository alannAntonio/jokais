<?php
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$hoy = date("m,d,Y");
$mes = explode(",", $hoy);
$mesNum = $mes[0];
$mesPal = $meses[$mesNum-1];
echo $mesPal;
?>