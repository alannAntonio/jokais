<?php
include("conexion.php");
$query = "SELECT * FROM clientes WHERE dv='1'";
$result = $mysqli->query($query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$nombre = $row["nombre"];
echo $nombre;
$result->free();
$mysqli->close();
?>