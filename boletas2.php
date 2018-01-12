<!DOCTYPE html>
<html>
<head>
	<title>Boletas | JOKAIS</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/boletas.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
</head>
<body>
	<div class="contain1">
		<div class="logo"><img src="images/logo.png"></div>
		<div class="info">
			<p>Bienvenido Carlos Guzmán</p>
			<p><a href="#">Cerrar Sesión</a></p>
		</div>
	</div>

	<div class="contain2">
		<h2>Boletas</h2>
		<p>Gestiona y emite tus boletas</p>
	</div>

	<div class="contain3">
		<div class="pestanas">
			<div class="opcion" id="emision">Gestion</div>
			<div class="opcion" id="gestion">Detalle</div>
		</div>

		<div class="contenido_gestion">
			<div id="contenido_gestion">
				<div class="contenedor_tabla1">
					<form class="form_contenido">					
						<table>
							<tr>
								<td><legend>Parámetros de búsqueda</legend></td>
							</tr>			
							<tr>
								<td>Mes</td>
								<td>:</td>
								<td>
									<select>
									<option>Enero</option>
									<option>Febrero</option>
									<option>Marzo</option>
									<option>Abril</option>
									<option>Mayo</option>
									<option>Junio</option>
									<option>Julio</option>
									<option>Agosto</option>
									<option>Septiembre</option>
									<option>Octubre</option>
									<option>Noviembre</option>			
									<option>Diciembre</option>
								</select>
								</td>
							</tr>
							<tr>
								<td>Cliente</td>
								<td>:</td>
								<td><input type="text" name="cliente"></td>
							</tr>
							<tr>
								<td>Boleta</td>
								<td>:</td>
								<td><input type="text" name="cliente"></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td><input type="submit" name="buscar" value="Buscar"></td>			
							</tr>
						</table>
					
					</form>
				</div>

				<div class="mostrar_boleta">					
					<div id="check"></div><p>Emitida</p>
						
				</div>
				<div class="acciones">
					<p>Operaciones</p>
					<form class="formulario_acciones">
						<table>
							<tr>
								<td width="50%"><label for="descuento">Descuento</label></td>
								<td><input type="text" name="descuento"></td>
							</tr>
							<tr>
								<td><label for="gastos">Gastos operacionales</label></td>
								<td><input type="text" name="gastos"></td>
							</tr>
							<tr>
								<td><label for="corte_rep">Corte/Reposición</label></td>
								<td><input type="text" name="corte_rep"></td>
							</tr>
							<tr>
								<td><label>Intereses por mora :</label></td>
								<td></td>
							</tr>
							<tr>
								<td><label for="dias">Días</label><input type="text" name="dias"></td>
								<td><label for="total_interes">Total interés</label>
						<input type="text" name="total_interes"></td>
							</tr>
							<tr>
								<td><strong>Nuevo total</strong></td>
								<td><input type="text" name="nuevo_total" disabled="disabled" value="Mucho"></td>
							</tr>
							<tr>
								<td><input type="submit" name="modificar" value="Modificar" class="deshabilitado"></td>
								<td><input type="submit" name="emitir" value="Emitir"></td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>

		<div class="contenido_detalle">
			<div id="contenido_detalle">				
				<div class="tabla_detalle">
					<div id="contenedor_busqueda">
							<form class="formulario_busqueda">
								<label>Mes</label>
								<select>
									<option>Enero</option>
									<option>Febrero</option>
									<option>Marzo</option>
									<option>Abril</option>
									<option>Mayo</option>
									<option>Junio</option>
									<option>Julio</option>
									<option>Agosto</option>
									<option>Septiembre</option>
									<option>Octubre</option>
									<option>Noviembre</option>
									<option>Diciembre</option>
								</select>
								<input type="submit" name="buscar" value="Buscar">
							</form>
					</div>	

					<form class="formulario_detalle">			
					<table id="tabla_detalle">						

						
						<tr>
							<td width="35%"><strong>Cliente</strong></td>
							<td width="30%"><strong>N° Boleta</strong></td>
							<td width="25%"><strong>Estado</strong></td>
							<td width="10%"><strong>Accion</strong></td>
						</tr>
						<tr>
							<td>18222414</td>
							<td id="986766">986766</td>
							<td>Sin lectura</td>
							<td><input type="checkbox" name="986766"></td>
						</tr>
						<tr>
							<td>18222414</td>
							<td id="986766">986766</td>
							<td>Sin lectura</td>
							<td><input type="checkbox" name="986766"></td>
						</tr>
						<tr>
							<td>18222414</td>
							<td id="986766">986766</td>
							<td>Sin lectura</td>
							<td><input type="checkbox" name="986766"></td>
						</tr>
						<tr>
							<td>18222414</td>
							<td id="986766">986766</td>
							<td>Sin lectura</td>
							<td><input type="checkbox" name="986766"></td>
						</tr>
						
					</table>
					<div class="formulario_emitir">
						<input type="submit" name="seleccionar" value="Seleccionar todo">
						<input type="submit" name="deseleccionar" value="Deseleccionar">
						<input type="submit" name="emitir" value="Emitir seleccion">
					</div>					
					</form>
				</div>
			</div>
		</div>
	</div>

</body>
</html>