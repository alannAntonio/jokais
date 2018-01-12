<?php
require("conexion.php");
$tabla = $_POST['tablaBusqueda'];
$option = $_POST['optionBusqueda'];
if(isset($tabla)){
	$consulta = "SELECT * FROM $tabla order by id desc";
	$result = $mysqli->query($consulta);
	$count = mysqli_num_rows($result);
	$cont = 0;
	echo'
		<div id="show-title">
			<h2>'.$option.'</h2>
			<p> N° registros: '.$count.'</p>
		</div>

		<div id="table-contain">
			<table class="table">
				<tr class="thead">
					<th></th>
					<th id="llave">Id</th>
					<th id="llave">Medidor</th>
					<th id="date">Fecha</th>
					<th id="number">Kw</th>
				</tr>


		';
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){

			if($cont%2 == 0){
				echo '<tr class="file-light fila">';
			}else{
				echo '<tr class="fila">';
			}
	        echo '
	        <td class="celda">
	         <div id="option-icon" class="clase option-icon">
	         	<img onclick="editarLecturas(this);" id="editar" src="images/editar.png"/>
	         	<img onclick="eliminar(this);" id="eliminar" src="images/basurero.png"/>
	         <div>

	        </td>
	        <td>'.$row['id'].'</td>
	        <td>'.$row['medidor'].'</td>
	        <td>'.$row['fecha'].'</td>
	        <td>'.$row['kw'].'</td>
	        </tr>
	        	';

	        $cont++;
		};
}
echo '
	</table>
</div>
';
?>