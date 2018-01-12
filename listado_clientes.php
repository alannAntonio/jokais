<?php
require("conexion.php");
$consulta = "SELECT * FROM clientes ORDER BY id asc";
$result = $mysqli->query($consulta);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$count = mysqli_num_rows($result);
$cont = 1;
if ($result = $mysqli->query($consulta)) {

    while ($fila = $result->fetch_row()) {  
    	if($cont%2==0){ 	
	        echo '<tr class="linea_blanco" id="'.$fila[4].'">
	        		<td>'.ucwords($fila[1].' '.$fila[2]).'</td>
	        		<td>'.ucwords($fila[6]).'</td>
	        		<td>$'.$fila[13].'</td>
	        	  </tr>';
	    }else{
	    	echo '<tr class="linea_celeste" id="'.$fila[4].'">
	        		<td>'.ucwords($fila[1].' '.$fila[2]).'</td>
	        		<td>'.ucwords($fila[6]).'</td>
	        		<td>$'.$fila[13].'</td>
	        	  </tr>';
	    }
	    $cont++;

    };
    $result->close();
}
$mysqli->close();
?>