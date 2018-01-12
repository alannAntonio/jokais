<?php
require("conexion.php");
$tabla = $_POST['tablaBusqueda'];
$option = $_POST['optionBusqueda'];
if(isset($tabla)){
	$consulta = "SELECT * FROM $tabla order by fecha_emision desc";
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
					<th id="llave">N° Boleta</th>
					<th id="disabled">medidor</th>
					<th id="date">F. Emisión</th>
					<th id="date">F. Venc</th>
					<th id="number">Lect. Actual</th>
					<th id="disabled">Lect. Anterior</th>
					<th id="disabled">Valor Kw</th>
					<th id="disabled">Consumo Kw</th>
					<th id="disabled">Consumo $</th>
					<th id="disabled">Cargo Fijo</th>
					<th id="disabled">Cliente</th>
					<th id="disabled">Saldo Anterior</th>
					<th id="disabled">Saldo Favor</th>
					<th id="disabled">Corte/Rep</th>
					<th id="disabled">Gastos Op.</th>
					<th id="disabled">Interes</th>
					<th id="disabled">Total</th>
					<th id="disabled">Monto últ. Pago</th>
					<th id="disabled">Fecha últ. Pago</th>
					<th id="disabled">Método</th>
					<th id="disabled">Código Pago</th>
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
	         	<img onclick="editarBoletas(this);" id="editar" src="images/editar.png"/>
	         	<img onclick="eliminar(this);" id="eliminar" src="images/basurero.png"/>
	         <div>

	        </td>
	        <td>'.$row['numero_boleta'].'</td>
	        <td>'.$row['medidor'].'</td>
	        <td>'.$row['fecha_emision'].'</td>
	        <td>'.$row['fecha_vencimiento'].'</td>
	        <td>'.$row['lectura_actual'].'</td>
	        <td>'.$row['lectura_anterior'].'</td>
	        <td>'.$row['valor_kw'].'</td>
	        <td>'.$row['consumo_kw'].'</td>
	        <td>'.$row['consumo_dinero'].'</td>
	        <td>'.$row['cargo_fijo'].'</td>
	        <td>'.$row['cliente'].'</td>
	        <td>'.$row['saldo_anterior'].'</td>
	        <td>'.$row['saldo_favor'].'</td>
	        <td>'.$row['corte_reposicion'].'</td>
	        <td>'.$row['gastos_operacionales'].'</td>
	        <td>'.$row['interes'].'</td>
	        <td>'.$row['total'].'</td>
	        <td>'.$row['monto_ultimo_pago'].'</td>
	        <td>'.$row['fecha_ultimo_pago'].'</td>
	        <td>'.$row['metodo'].'</td>
	        <td>'.$row['codigo_pago'].'</td>

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