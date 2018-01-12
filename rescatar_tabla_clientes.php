<?php
require("conexion.php");
$tabla = $_POST['tablaBusqueda'];
$option = $_POST['optionBusqueda'];
if(isset($tabla)){
	$consultaDeuda = "SELECT SUM(deuda) AS deudaTotal FROM clientes";
	$verDeuda = $mysqli->query($consultaDeuda);
	$row1 = mysqli_fetch_array($verDeuda,MYSQLI_ASSOC);
	$deuda = "$".(number_format($row1["deudaTotal"], 0,",",".")) ;

	$consulta = "SELECT * FROM $tabla order by nombre asc";
	$result = $mysqli->query($consulta);
	$count = mysqli_num_rows($result);
	$cont = 0;
	echo'
		<div id="show-title">
			<h2>'.$option.'</h2>
			<p>Total clientes: '.$count.'</p>
			<p>Total deuda: '.$deuda.'</p>
			<p class="btn-agregar" onclick="agregarUsuario();">Agregar usuario [+]</p>
		</div>

		<div id="table-contain">
			<table class="table">
				<tr class="thead">
					<th></th>
					<th>Nombre</th>
					<th>Apellido Pat</th>
					<th>Apellido Mat</th>
					<th id="number">Rut</th>
					<th>Dv</th>
					<th>Pseudónimo</th>
					<th>Calle Nombre</th>
					<th>Calle N°</th>
					<th id="number">Fono</th>
					<th id=email>Correo</th>
					<th id="llave">Medidor</th>
					<th id="date">Incorporación</th>
					<th id="number">Deuda</th>
					<th id="number">Saldo Favor</th>
					<th>Password</th>
					<th>Credencial</th>
					<th id="number">Mod Pass</th>
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
	         	<img onclick="editarClientes(this);" id="editar" src="images/editar.png"/>
	         	<img onclick="eliminar(this);" id="eliminar" src="images/basurero.png"/>
	         <div>

	        </td>
	        <td>'.$row['nombre'].'</td>
	        <td>'.$row['apellidopat'].'</td>
	        <td>'.$row['apellidomat'].'</td>
	        <td>'.$row['rut'].'</td>
	        <td>'.$row['dv'].'</td>
	        <td>'.$row['pseudonimo'].'</td>
	        <td>'.$row['calle_nombre'].'</td>
	        <td>'.$row['calle_numero'].'</td>
	        <td>'.$row['fono'].'</td>
	        <td>'.$row['correo'].'</td>
	        <td>'.$row['medidor'].'</td>
	        <td>'.$row['fecha_incorporacion'].'</td>
	        <td>'.$row['deuda'].'</td>
	        <td>'.$row['saldo_favor'].'</td>
	        <td>'.$row['passcode'].'</td>
	        <td>'.$row['credencial'].'</td>
	        <td>'.$row['modificacion_password'].'</td>
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