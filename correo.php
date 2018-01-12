<?php
$mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$mesHoy = date("d-m-Y");
$mesHoy = explode("-", $mesHoy);
if($mesHoy[1] < 2){
 $mesHoy[1] = 12;
}
$mesHoy = $mesHoy[1]-1;
$mesHoy = $mes[$mesHoy-1];
$mensaje = '

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
</head>
<body>
	<table style="width: 100%;margin:0px auto;padding: 20px 0px;font-family: \'Roboto Condensed\';">
		<tr style="width: 100%;text-align: right;"><td style="padding: 20px 0px;"><img width="200px" src="https://www.jokais.cl/images/logo.png"></td></tr>
		<tr><td style="text-align: center;border-bottom: 2px solid #FF4E4E;padding: 20px 0px;"><h1 style="font-size: 2.5em;color: #2BBF93;">¡Hola '.$nombreCliente.'!</h1>Te informamos que tu boleta correspondiente al consumo de '.$mesHoy.' ya está disponible.</td></tr>
		<tr>
			<td>
			<table style="padding: 20px 0px;">
				<tr>
					<td style="text-align: center; width: 50%;"><a href="https://www.jokais.cl/archivo/'.$rutaBoleta.'.pdf"><img style="width: 100%;max-width: 200px; margin: 0px auto;" src="https://www.jokais.cl/images/thumbnail2.png"></a></td>
					<td style="text-align: center; width: 50%;">
						<table width="90%;">
							<tr>
								<td>
									<table style="text-align: center;font-size: 1em;width: 100%;padding: 4%;background-color: #FF714E;color: #FFFFFF;">
										<tr>
											<td width="100%;">N° Cliente</td>											
										</tr>
										<tr>
											<td style="font-size: 1.2em;font-weight: bold;">'.$numeroCliente.'</td>											
										</tr>
										<tr>
											<td></td>											
										</tr>
										<tr>
											<td>Fecha emisión</td>											
										</tr>
										<tr>
											<td style="font-size: 1.2em;font-weight: bold;">'.$fechaEmision.'</td>											
										</tr>
										<tr>
											<td></td>											
										</tr>
										<tr>
											<td>Fecha vencimiento</td>											
										</tr>
										<tr>
											<td style="font-size: 1.2em;font-weight: bold;">'.$fechaVencimiento.'</td>											
										</tr>
										<tr>
											<td></td>											
										</tr>
										<tr>
											<td>Monto a cancelar</td>											
										</tr>
										<tr>
											<td style="font-size: 1.2em;font-weight: bold;">$'.$montoPagar.'</td>											
										</tr>
										<tr>
											<td></td>											
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td style="text-align: right;font-style: italic;text-decoration: none;font-size: 0.9em;">No dejes de visitar tu portal en <a style="text-decoration: none;" href="https://www.jokais.cl">www.jokais.cl</a> para ver el detalle de tus consumos y descargar boletas anteriores.</td>
							</tr>
						</table>						
						
					</td>
				</tr>
			</table>
			</td>
		</tr>
		<tr>
			<td style="text-align: center;border-top: 2px solid #FF4E4E;"><h3 style="font-size: 1em; font-weight: normal;">Para resolver tus dudas contáctanos al correo contacto@jokais.cl</h3>
			<h4 style="font-weight: normal; font-size: 0.8em;margin: 0px;color: #4AD66D;">No imprimas este archivo si no es necesario ¡Cuidemos el medio ambiente!</h4>
			</td>
		</tr>
	</table>
</body>
</html>


';
?>