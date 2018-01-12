<?php
	session_start();
	if(!($_SESSION["administrador"] === TRUE)){
		header("location:admin.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registros | JOKAIS</title>
	<link rel="shortcut icon" href="images/favicon.png">
	<link rel="stylesheet" type="text/css" href="css/registros.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
	<script src="js/registros.js"></script>

</head>
<body>
	<div class="contain1">
		<div class="logo"><img src="images/logo-blanco.png"></div>
		<div class="info">
			<p>Bienvenid@ <?php echo $_SESSION["nombre"]; ?></p>
			<p><a href="salir_admin.php">Cerrar Sesión</a></p>
		</div>
	</div>
	<div id="options-container">
		<div id="options-title">
			<h1>Editor de registros</h1>
			<p>Selecciona, inspecciona y edita los registros del sistema.</p>
		</div>
		<div id="options-list">
			<ul>
				<li class="option">Información Usuarios</li>
				<li class="option">Colaboradores</li>
				<li class="option">Lecturas</li>
				<li class="option">Boletas</li>
				<li class="option">Pagos</li>
			</ul>
		</div>
	</div>
	<div id="editar-show">
		<div id="x-editar">Cerrar[x]</div>
		<div id="editar-container">
		</div>
	</div>
	<div id="agregar-show">
		<div id="x-agregar">Cerrar[x]</div>
		<div id="agregar-container"></div>
	</div>
	<div id="confirmacion-eliminar-show">
		<div id="confirmacion-eliminar-container">
			<div id="confirmacion-eliminar">

			</div>
		</div>
	</div>
	<div id="menu">
		<img src="images/menu-hamburguer.png">
	</div>
	<div id="show-container">
		<!-- Aquí va el contenido dinámico -->
	</div>
</body>
</html>