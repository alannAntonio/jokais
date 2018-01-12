<?php
require("conexion.php");
$mensaje = "";
$mensaje1 = "";
$mensaje2 = "";
$mensaje3 = "</table>";
if (isset($_POST['ordenar'])) {
	$ordenar = $_POST['ordenar'];
	if($ordenar == "porDeuda"){
		$consulta = "SELECT * FROM clientes ORDER BY deuda desc";
	}elseif($ordenar == "porCliente"){
		$consulta = "SELECT * FROM clientes ORDER BY nombre asc";
	}elseif($ordenar == "porUsuario"){
		$consulta = "SELECT * FROM clientes ORDER BY pseudonimo asc";
	};
	$mensaje1 = '

	<table cellspacing="0px" cellpadding="10px">
			<tr>
				<td class="tabla_titulo" id="porCliente" width="50%">Cliente</td>
				<td class="tabla_titulo" id="porUsuario" width="30%">Usuario</td>
				<td class="tabla_titulo" id="porDeuda" >Deuda</td>
			</tr>								
	';
	

	$result = $mysqli->query($consulta);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$count = mysqli_num_rows($result);
	$cont = 1;

	
	if ($result = $mysqli->query($consulta)) {

	    while ($fila = $result->fetch_row()) {  
	    	if($cont%2==0){ 	
	        $mensaje2 = $mensaje2. '<tr class="cursorpointer linea_blanco" class="linea_blanco" id="'.$fila[4].'">
	        		<td>'.ucwords($fila[1].' '.$fila[2]).'</td>
	        		<td>'.ucwords($fila[6]).'</td>
	        		<td>$'.$fila[13].'</td>
	        	  </tr>';
		    }else{
		    	$mensaje2 = $mensaje2. '<tr class="cursorpointer linea_celeste" class="linea_celeste" id="'.$fila[4].'">
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

};
$mensaje4 = '
	<script  type="text/javascript">
	$(".cursorpointer").click(function () {
		$(".contenedor_ingreso").show();
		$(".contenedor_listado").hide();
		oID = $(this).attr("id");
		buscar_pago(oID);
	});
	</script>
';
$mensaje = $mensaje1.$mensaje2.$mensaje3.$mensaje4;
echo $mensaje;
?>