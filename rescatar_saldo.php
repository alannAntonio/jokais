<?php
function rescatar_saldo ($rut){
      include("conexion.php");
      $rut = $rut;
      $sql = "SELECT * FROM clientes WHERE rut = '$rut'";
            $result = $mysqli->query($sql);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $deuda = $row["deuda"];      
            $count = mysqli_num_rows($result);
      		
            if($count == 1) {
            	$deuda = number_format($deuda,0,",",".");
             return "$".$deuda;                                               
            }else{
            	return "N/E";
            }
}
?>