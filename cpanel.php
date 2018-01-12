<?php
	session_start();
	if(!($_SESSION["administrador"] === TRUE)){
		header("location:admin.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cpanel | JOKAIS</title>
	<link rel="shortcut icon" href="images/favicon.png">
	<link rel="stylesheet" type="text/css" href="css/cpanel.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div class="contain1">
		<div class="logo"><img src="images/logo.png"></div>
		<div class="info">
			<p>Bienvenido <?php echo $_SESSION["nombre"]; ?></p>
			<a href="salir_admin.php"><p>Cerrar Sesión</p></a>
		</div>
	</div>
	<h1>Panel de administración</h1>
	<div class="contain2">


		<div class="tarjeta" id="lectura">
				<a href="lectura">
					<div id="image">
						<img src="images/010-hemoglobin.png">
					</div>
					<p>LECTURA</p>
				</a>
		</div>

		<?php
			if($_SESSION['credencial'] == "administrador"){
				echo'

					<div class="tarjeta" id="pagos">
						<a href="pagos">
							<div id="image">
								<img src="images/009-tarjeta-de-credito.png">
							</div>
							<p>PAGOS</p>
						</a>
					</div>

					<div class="tarjeta" id="boletas">
						<a href="boleta">
							<div id="image">
								<img src="images/008-archivo.png">
							</div>
							<p>BOLETAS</p>
						</a>
					</div>

					<div class="tarjeta" id="clientes">
						<a href="registros">
							<div id="image">
								<img src="images/007-servicio-al-cliente.png">
							</div>
							<p>Registros</p>
						</a>
					</div>


				';
			}elseif($_SESSION['credencial'] == "pagos"){
				echo '<div class="tarjeta" id="pagos">
						<a href="pagos">
							<div id="image">
								<img src="images/009-tarjeta-de-credito.png">
							</div>
							<p>PAGOS</p>
						</a>
					</div>

					<div class="tarjeta" id="boletas">
						<a href="boleta">
							<div id="image">
								<img src="images/008-archivo.png">
							</div>
							<p>BOLETAS</p>
						</a>
					</div>';

			}elseif($_SESSION['credencial'] == "boletas"){
				echo '
					<div class="tarjeta" id="boletas">
						<a href="boleta">
							<div id="image">
								<img src="images/008-archivo.png">
							</div>
							<p>BOLETAS</p>
						</a>
					</div>';

			}
		?>

	</div>
</body>
</html>