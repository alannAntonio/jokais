<?php
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$hoy = date("m,d,Y");
$mes = explode(",", $hoy);
$mesNum = $mes[0];
$mesPal = $meses[$mesNum-1];
$i = 0;
$imprimir = "";
$imprimir ='<select class="select2">';

for($i = 0; $i <= 11; $i++){
	if($meses[$i]=== $mesPal){
		$imprimir = $imprimir. '<option selected>'.$meses[$i].'</option>';
	}else{
		$imprimir = $imprimir. '<option>'.$meses[$i].'</option>';
	}
}
$imprimir = $imprimir.'</select>';
echo $imprimir;
?>