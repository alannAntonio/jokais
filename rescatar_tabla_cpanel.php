<?php
require("conexion.php");
$tabla = $_POST['tablaBusqueda'];
$option = $_POST['optionBusqueda'];
if(isset($tabla)){
	$consulta = "SELECT * FROM $tabla order by id asc";
	$result = $mysqli->query($consulta);
	$count = mysqli_num_rows($result);
	$cont = 0;
	echo'
		<div id="show-title">
			<h2>'.$option.'</h2>
			<p> N° Colaboradores: '.($count-1).'</p>
			<p class="btn-agregar" onclick="agregarColaborador();">Agregar colaborador [+]</p>
		</div>

		<div id="table-contain">
			<table class="table">
				<tr class="thead">
					<th></th>
					<th>Nombre</th>
					<th>Apellido</th>
					<th id="llave">Rut</th>
					<th>Dv</th>
					<th>Password</th>
					<th id="select">Credencial</th>
					<th id="email">Email</th>
					<th id="number">Fono</th>
				</tr>


		';
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
			if($row['rut'] != "18222414"){
				if($cont%2 == 0){
					echo '<tr class="file-light fila">';
				}else{
					echo '<tr class="fila">';
				}
		        echo '
		        <td class="celda">
		         <div id="option-icon" class="clase option-icon">
		         	<img onclick="editarColaboradores(this);" id="editar" src="images/editar.png"/>
		         	<img onclick="eliminar(this);" id="eliminar" src="images/basurero.png"/>
		         <div>

		        </td>
		        <td>'.$row['nombre'].'</td>
		        <td>'.$row['apellido'].'</td>
		        <td>'.$row['rut'].'</td>
		        <td>'.$row['dv'].'</td>
		        <td>'.$row['passcode'].'</td>
		        <td>'.$row['credencial'].'</td>
		        <td>'.$row['email'].'</td>
		        <td>'.$row['fono'].'</td>
		        </tr>
		        	';
				}
	        $cont++;
		};
}
echo '
	</table>
</div>
';
?>