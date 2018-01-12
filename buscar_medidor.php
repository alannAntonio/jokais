<?php
require('conexion.php');
$consultaBusqueda = $_POST['valorBusqueda'];

$caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
$caracteres_buenos = array("& lt;", "& gt;", "& quot;", "& #x27;", "& #x2F;", "& #060;", "& #062;", "& #039;", "& #047;");
$consultaBusqueda = str_replace($caracteres_malos, $caracteres_buenos, $consultaBusqueda);

$mensaje = "";
$estado = '<div class="estado" id="desactualizado">Desactualizado</div>';
if (isset($consultaBusqueda)) {

	$consulta = "SELECT * FROM clientes	WHERE medidor = '$consultaBusqueda' ";
	$result = $mysqli->query($consulta);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$count = mysqli_num_rows($result);

	if($count === 0){
		$mensaje = "<p>No se encontró número de medidor <strong>".$consultaBusqueda."</strong></p>";
	}else{			
		$nombre = ucwords($row['nombre'].' '.$row['apellidopat'].' '.$row['apellidomat']);
		$deuda = $row['deuda'];
		$deuda = '$'.number_format($deuda, 0, "," ,"." );			
		$rut = $row['rut'];
		$direccion = ucwords($row['calle_nombre'].' '.$row['calle_numero']);

		$consulta = "SELECT * FROM lecturas	WHERE medidor = '$consultaBusqueda'  order by fecha desc limit 1";
		$result = $mysqli->query($consulta);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$count = mysqli_num_rows($result);
		if ($count != 0){
			$ultima_lectura_kw = $row['kw'].'Kw';
			$fecha = $row['fecha'];
			$fecha = new DateTime($fecha);
			$fecha_echo = '('.$fecha->format('d/m/Y').')';				

			$hoy = date("d/m/Y");		
			$dia = explode("/", $hoy);

			if($dia[0]<28){
				if($dia[1]<2){
					$fecha1 = ($dia[2]-1)."/12/28";
				}else{
					$fecha1 = $dia[2]."/".($dia[1]-1)."/28";
				}					
				$fecha2 = $dia[2]."/".$dia[1]."/12";					
			}else{
				$fecha1 = $dia[2]."/".($dia[1])."/28";
				$fecha2 = date("Y/m/d");			
			}
			$consulta = "SELECT fecha FROM lecturas	WHERE medidor = '$consultaBusqueda' AND fecha BETWEEN '$fecha1' AND '$fecha2' order by fecha desc limit 1";
			$result = $mysqli->query($consulta);
			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
			$count = mysqli_num_rows($result);
			if ($count === 0) {
				$estado = '<div class="estado" id="desactualizado">Desactualizado</div>';
			}else{
				$estado = '<div class="estado" id="actualizado">Actualizado</div>';
			}
		}else{
			$ultima_lectura_kw = "No existe información";
			$fecha_lectura = "";
			$fecha_echo = ".";				
		};
		

		$mensaje .= '
		
			<table>
				<tr>
					<td>Nombre</td>
					<td>:</td>
					<td>'.$nombre.'</td>
				</tr>
				<tr>
					<td>N° Cliente</td>
					<td>:</td>
					<td>'.$rut.'</td>
				</tr>
				<tr>
					<td>Dirección</td>
					<td>:</td>
					<td>'.$direccion.'</td>
				</tr>
				<tr>
					<td>Deuda</td>
					<td>:</td>
					<td>'.$deuda.'</td>
				</tr>
				<tr>
					<td>Última lectura</td>
					<td>:</td>
					<td>'.$ultima_lectura_kw.$fecha_echo.'</td>
				</tr>

			</table>
		';									
	}; 

};
echo $mensaje;
echo $estado;
?>